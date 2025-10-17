<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order; // Asumsi ada model Order untuk transaksi
use App\Models\TrackingLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // --- DATA UNTUK KARTU STATISTIK ATAS (UMUM) ---
        $totalLoginHariIni = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::today()->startOfDay()->timestamp)
            ->count();
        $userAktif = User::where('status', 'active')->count();
        $totalTransaksi = Order::count();
        $uptimeSistem = '99.9%'; // Data ini biasanya dari service monitoring eksternal

        // --- DATA UNTUK TAB ANALITIK ---

        // 1. Grafik Login Harian (7 Hari Terakhir)
        $loginsLast7Days = DB::table('sessions')
            ->select(DB::raw('DATE(FROM_UNIXTIME(last_activity)) as date'), DB::raw('count(distinct user_id) as logins'))
            ->where('last_activity', '>=', Carbon::now()->subDays(6)->startOfDay()->timestamp)
            ->groupBy('date')->orderBy('date', 'ASC')->pluck('logins', 'date');

        $chartLabels = [];
        $chartData = [];
        $period = now()->subDays(6)->startOfDay()->toPeriod(now()->endOfDay());
        foreach ($period as $date) {
            $chartLabels[] = $date->isoFormat('ddd');
            $chartData[] = $loginsLast7Days->get($date->format('Y-m-d'), 0);
        }

        // 2. Grafik Aktivitas by Role (Pie Chart)
        $aktivitasByRole = User::join('roles', 'users.id_role', '=', 'roles.id')
            ->join('tracking_logs', 'users.id', '=', 'tracking_logs.changed_by')
            ->select('roles.name', DB::raw('count(tracking_logs.id_log) as total'))
            ->groupBy('roles.name')
            ->pluck('total', 'name');

        // [PERBAIKAN] 3. Ringkasan Penggunaan Sistem (Data Dinamis dari Tabel `sessions`)
        $sesi30Hari = DB::table('sessions')->where('last_activity', '>=', now()->subDays(30)->timestamp);

        $totalSesi = $sesi30Hari->count();
        $uniqueVisitors = $sesi30Hari->distinct('user_id')->count('user_id');

        // Menghitung Rata-rata Durasi Sesi (dalam menit)
        $durasiSesi = DB::table('sessions')
            ->select('user_id', DB::raw('MAX(last_activity) - MIN(last_activity) as duration'))
            ->where('last_activity', '>=', now()->subDays(30)->timestamp)
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->pluck('duration');

        $rataRataDurasiDetik = $durasiSesi->avg();
        $rataRataDurasi = $rataRataDurasiDetik ? round($rataRataDurasiDetik / 60) . ' menit' : '0 menit';

        // Menghitung Return Users (pengguna dengan lebih dari 1 sesi)
        $sesiPerUser = DB::table('sessions')
            ->select('user_id', DB::raw('COUNT(id) as session_count'))
            ->where('last_activity', '>=', now()->subDays(30)->timestamp)
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->having('session_count', '>', 1)
            ->get();
        $returnUsers = $sesiPerUser->count();

        $ringkasanSistem = [
            'total_sesi' => number_format($totalSesi),
            'pages_views' => 'N/A', // Data ini tidak tersedia di tabel sessions
            'rata_rata_durasi' => $rataRataDurasi,
            'unique_visitors' => number_format($uniqueVisitors),
            'bounce_rate' => 'N/A', // Data ini tidak tersedia
            'return_users' => number_format($returnUsers),
            'error_rate' => '0.3%', // Data dummy, biasanya dari service log
            'response_time' => '124 ms', // Data dummy, biasanya dari service monitoring
            'storage_used' => '2.1 GB' // Data dummy, perlu dihitung manual dari server
        ];

        // --- DATA UNTUK TAB LOG AKTIVITAS ---
        $logAktivitas = TrackingLog::with('changedBy')->latest('changed_at')->paginate(10);

        return view('AdminSekolah.laporan', compact(
            'totalLoginHariIni',
            'userAktif',
            'totalTransaksi',
            'uptimeSistem',
            'chartLabels',
            'chartData',
            'aktivitasByRole',
            'ringkasanSistem',
            'logAktivitas'
        ));
    }
}
