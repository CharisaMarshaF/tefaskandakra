<?php

namespace App\Http\Controllers\Siswas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class SiswasController extends Controller
{
    protected $siswa;
    protected $project_progress;
    protected $project_grades;
    protected $jadwal_project;
    protected $perusahaan;


    public function __construct()
    {
        // Ambil data siswa sesuai user login
        $this->siswa = DB::table('siswas')
            ->where('id_user', auth()->id())
            ->first();

        if (!$this->siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }

        // Ambil data project progress
        $this->project_progress = DB::table('project_progress as pp')
            ->leftJoin('projects as p', 'pp.id_project', '=', 'p.id')
            ->select(
                'pp.id',
                'pp.id_siswa',
                'pp.id_project',
                'pp.tanggal',
                'pp.progress_percent',
                'pp.deskripsi',
                'pp.file_id',
                'pp.submitted_by',
                'p.nama_project',
                'p.deadline',
                'p.start_date'
            )
            ->where('pp.id_siswa', $this->siswa->id)
            ->orderByDesc('pp.tanggal')
            ->get();

        // Ambil data project grades
        $this->project_grades = DB::table('project_grades as pg')
            ->leftJoin('projects as p', 'pg.id_project', '=', 'p.id')
            ->leftJoin('files as f', 'pg.sertifikat_file_id', '=', 'f.id')
            ->where('pg.id_siswa', $this->siswa->id)
            ->select(
                'pg.id',
                'pg.id_project',
                'pg.nilai',
                'pg.feedback',
                'pg.graded_by',
                'pg.graded_at',
                'p.nama_project',
                'p.deskripsi as deskripsi',
                'p.start_date',
                'p.deadline',
                'f.nama_file as dokumen_nama_file',
                'f.id as dokumen_id'
            )
            ->get();

            $this->jadwal_project = DB::table('jadwal_produksi as jp')
                ->leftJoin('projects as p', 'jp.id_project', '=', 'p.id')
                ->leftJoin('kelas_industris as ki', 'jp.id_kelasindustri', '=', 'ki.id')
                ->where('jp.id_project', $this->siswa->id)
                ->whereDate('jp.tanggal_mulai', Carbon::today()) // ✅ Filter hanya tanggal hari ini
                ->select(
                    'jp.id',
                    'jp.id_project',
                    'jp.id_kelasindustri',
                    'jp.tanggal_mulai',
                    'jp.jam_mulai',
                    'jp.catatan',
                    'p.nama_project',
                    'ki.nama_kelas'
                )
                ->get();

                $this->perusahaan = DB::table('perusahaans')->get();

                
    
    }

    public function index()
    {
        return view('siswa.index', [
            'siswa' => $this->siswa,
            'project_progress' => $this->project_progress->take(3),
            'project_grades' => $this->project_grades,
            'jadwal_project' => $this->jadwal_project,

        ]);
    }

    public function kelasindustri()
    {
        return view('siswa.kelasindustri', [
            'perusahaan' => $this->perusahaan,
        ]);
    }

    public function produksi()
    {
        return view('siswa.produksi', [
            'project_grades' => $this->project_grades,
            'project_progress' => $this->project_progress,
            'jadwal_project' => $this->jadwal_project,
            ]
        );
    }

    public function laporan()
    {
        // Ambil daftar project yang bisa dipilih oleh siswa
        $projects = DB::table('projects')->get();

        return view('siswa.laporan', [
            'project_grades' => $this->project_grades,
            'project_progress' => $this->project_progress,
            'projects' => $projects,
        ]);
    }

    public function lihatnilai()
    {
        return view('siswa.lihatnilai', [
            'project_grades' => $this->project_grades
        ]);
    }

    /**
     * Simpan laporan progres yang diunggah siswa
     */
    public function storeProgress(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'deskripsi' => 'required|string',
        'progress_percent' => 'required|integer|min:0|max:100',
        'file_bukti' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Simpan file ke folder storage/app/public/uploads/progres
    $path = $request->file('file_bukti')->store('uploads/progres', 'public');

    // Simpan ke tabel files (opsional jika kamu punya tabel files)
    $file_id = DB::table('files')->insertGetId([
        'nama_file' => basename($path),
        'file_type' => $request->file('file_bukti')->getClientMimeType(),
        'uploaded_at' => now(),
    ]);

    // Simpan ke tabel project_progress
    DB::table('project_progress')->insert([
        'id_siswa' => $this->siswa->id,
        'id_project' => $request->project_id,
        'tanggal' => now(),
        'deskripsi' => $request->deskripsi,
        'file_id' => $file_id,
        'progress_percent' => $request->progress_percent, // ✅ ambil dari input
        'submitted_by' => auth()->id(),
    ]);

    return redirect()->route('siswa.laporan')->with('success', 'Laporan progres berhasil dikirim!');
}

}
