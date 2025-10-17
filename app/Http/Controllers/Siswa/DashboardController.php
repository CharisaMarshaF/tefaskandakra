<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            // Ambil data siswa
            $siswa = DB::table('siswas')->where('id_user', $user->id)->first();
            if (!$siswa) {
                return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
            }

            // 1. Total kelas industri
            //    - kalau siswa punya id_kelasindustri langsung dipakai
            //    - kalau tidak, cek dari project yang diikuti
            $totalKelasIndustri = DB::table('kelas_industris')
                ->where('id', $siswa->id_kelasindustri)
                ->count();

            if ($totalKelasIndustri == 0) {
                $totalKelasIndustri = DB::table('project_members')
                    ->join('projects', 'project_members.id_project', '=', 'projects.id')
                    ->where('project_members.id_siswa', $siswa->id)
                    ->distinct('projects.id_kelasindustri')
                    ->count('projects.id_kelasindustri');
            }

            // 2. Total project aktif siswa
            $totalProjectAktif = DB::table('project_members')
                ->join('projects', 'project_members.id_project', '=', 'projects.id')
                ->where('project_members.id_siswa', $siswa->id)
                ->where('projects.status', 'proses')
                ->count();

            // 3. Progress rata-rata dari semua project aktif
            $latestProgressSubquery = DB::table('project_progress')
                ->select(DB::raw('MAX(progress_percent) as progress_percent'), 'id_project')
                ->groupBy('id_project');

            $progressRataRata = DB::table('project_members')
                ->join('projects', 'project_members.id_project', '=', 'projects.id')
                ->joinSub($latestProgressSubquery, 'latest_progress', function ($join) {
                    $join->on('project_members.id_project', '=', 'latest_progress.id_project');
                })
                ->where('project_members.id_siswa', $siswa->id)
                ->where('projects.status', 'proses')
                ->avg('latest_progress.progress_percent');

            $progressRataRata = round($progressRataRata ?? 0);

            // 4. List project aktif + progress
            $projects = DB::table('project_members')
                ->join('projects', 'project_members.id_project', '=', 'projects.id')
                ->leftJoinSub($latestProgressSubquery, 'latest_progress', function ($join) {
                    $join->on('projects.id', '=', 'latest_progress.id_project');
                })
                ->where('project_members.id_siswa', $siswa->id)
                ->where('projects.status', 'proses')
                ->select(
                    'projects.nama_project',
                    'projects.expected_output',
                    'projects.deadline',
                    'projects.status',
                    DB::raw('COALESCE(latest_progress.progress_percent, 0) as progress')
                )
                ->get();

            // 5. Jadwal produksi hari ini (pakai range tanggal, bukan hanya start_date)
// 5. Jadwal produksi hari ini (berdasarkan project yg diikuti siswa)
$today = Carbon::today();
$validStatuses = ['proses', 'aktif']; // sesuaikan dgn status project aktif di db kamu

$jadwalHariIni = DB::table('jadwal_produksi')
    ->join('projects', 'jadwal_produksi.id_project', '=', 'projects.id')
    ->join('project_members', 'projects.id', '=', 'project_members.id_project')
    ->leftJoin('perusahaans', 'projects.id_perusahaan', '=', 'perusahaans.id') // kalau ada
    ->where('project_members.id_siswa', $siswa->id)
    ->whereIn('projects.status', $validStatuses)
    ->whereDate('jadwal_produksi.tanggal_mulai', '<=', $today)
    ->whereDate('jadwal_produksi.tanggal_selesai', '>=', $today)
    ->select(
        'projects.nama_project',
        'perusahaans.nama as nama_perusahaan',
        'jadwal_produksi.jam_mulai',
        'jadwal_produksi.jam_selesai'
    )
    ->get();


            return view('siswa.dashboard', compact(
                'siswa',
                'totalKelasIndustri',
                'totalProjectAktif',
                'progressRataRata',
                'projects',
                'jadwalHariIni'
            ));

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat memuat data dashboard.');
        }
    }
}
