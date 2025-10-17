<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Perusahaan;
use App\Models\Project;
use App\Models\Role;
use App\Models\TrackingLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Data untuk Kartu Ringkasan (Summary Cards)
        $totalUser = User::count();
        $jurusanAktif = Jurusan::count(); // Asumsi semua jurusan aktif

        // Menghitung login hari ini dari tabel sessions Laravel
        $loginHariIni = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::today()->startOfDay()->timestamp)
            ->count();

        $mitraDUDI = Perusahaan::count(); // Asumsi tabel 'perusahaans' untuk Mitra DUDI

        // 2. Data untuk Grafik Aktivitas Mingguan (1 Query Efisien)
        $loginsLast7Days = DB::table('sessions')
            ->select(DB::raw('DATE(FROM_UNIXTIME(last_activity)) as date'), DB::raw('count(distinct user_id) as logins'))
            ->where('last_activity', '>=', Carbon::now()->subDays(6)->startOfDay()->timestamp)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('logins', 'date');

        // Proses data untuk chart, mengisi hari yang kosong dengan 0
        $chartLabels = [];
        $chartData = [];
        $period = now()->subDays(6)->startOfDay()->toPeriod(now()->endOfDay());
        foreach ($period as $date) {
            $chartLabels[] = $date->isoFormat('ddd'); // Format: Sen, Sel, Rab
            $chartData[] = $loginsLast7Days->get($date->format('Y-m-d'), 0);
        }

        // 3. Data untuk Aktivitas Terbaru
        $aktivitasTerbaru = TrackingLog::with('changedBy') // Relasi ke user yang melakukan
            ->latest('changed_at')
            ->take(3)
            ->get();

        // 4. Data untuk Project Jurusan
        $projectJurusan = Jurusan::withCount('projects')->with('projects')->get()->map(function ($jurusan) {
            // Menghitung rata-rata progress dari semua project di jurusan ini
            $totalProgress = $jurusan->projects->reduce(function ($carry, $project) {
                // Asumsi progress disimpan di tempat lain, kita buat dummy progress
                // Untuk real-data, Anda perlu query progress terakhir dari setiap project
                return $carry + ($project->status == 'selesai' ? 100 : rand(50, 90));
            }, 0);

            $averageProgress = $jurusan->projects_count > 0 ? $totalProgress / $jurusan->projects_count : 0;

            return [
                'nama' => $jurusan->nama_jurusan,
                'jumlah_project' => $jurusan->projects_count,
                'progress' => round($averageProgress)
            ];
        });

        // 5. Data untuk Status Sistem (Biasanya dari service lain, di sini kita buat statis)
        $statusSistem = [
            'server_uptime' => '99.9%',
            'response_time' => '124ms',
            'error_rate' => '0.3%',
            'storage_used' => '2,1 GB',
        ];


        return view('AdminSekolah.dashboard', compact(
            'totalUser',
            'jurusanAktif',
            'loginHariIni',
            'mitraDUDI',
            'chartLabels',
            'chartData',
            'aktivitasTerbaru',
            'projectJurusan',
            'statusSistem'
        ));
    }

    public function laporan()
    {
        return view('AdminSekolah.laporan');
    }

    public function analisis()
    {
        return view('AdminSekolah.analisis');
    }

    public function user(Request $request)
    {
        // Data untuk kartu statistik
        $totalUser = User::count();
        $userAktif = User::where('status', 'active')->count();
        // Ambil ID untuk role Guru Pembimbing
        $guruRoleId = Role::where('name', 'Guru Pembimbing')->value('id');
        $totalGuru = User::where('id_role', $guruRoleId)->count();

        // 1. Ambil ID untuk semua role admin ('Admin TEFA' dan 'Admin Sekolah')
        $adminRoleIds = Role::whereIn('name', ['Admin TEFA', 'Admin Sekolah'])->pluck('id');
        // 2. Hitung semua user yang memiliki id_role yang ada di dalam koleksi ID tersebut
        $totalAdmin = User::whereIn('id_role', $adminRoleIds)->count();

        // Query dasar untuk mengambil user
        $query = User::with(['guru.jurusan', 'siswa.jurusan', 'role'])->latest();

        // Terapkan filter pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Terapkan filter berdasarkan role jika ada
        if ($request->has('role') && $request->role != '') {
            $query->where('id_role', $request->role);
        }

        $users = $query->paginate(10)->withQueryString();

        // Ambil semua role untuk dropdown filter
        $roles = Role::whereNotIn('name', ['Guru Pembimbing', 'Siswa'])->get();
        $rolesforFilter = Role::all();

        return view('AdminSekolah.users', compact(
            'users',
            'totalUser',
            'userAktif',
            'totalGuru',
            'totalAdmin',
            'roles',
            'rolesforFilter'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_role' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $request->id_role,
        ]);

        return redirect()->route('user.admin_sekolah')->with('success', 'User berhasil ditambahkan!');
    }

    // Method untuk mengambil data user (untuk modal edit)
    public function edit(User $user)
    {
        return response()->json($user);
    }

    // Method untuk memperbarui data user
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'id_role' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->id_role = $request->id_role;

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['success' => 'User berhasil diperbarui!']);
    }

    // Method untuk menghapus user
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.admin_sekolah')->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            return response()->back()->with('error', 'Gagal menghapus user.');
        }
    }

    public function jurusan()
    {
        return view('AdminSekolah.jurusan');
    }
}
