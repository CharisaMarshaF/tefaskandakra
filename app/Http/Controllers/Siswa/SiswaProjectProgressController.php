<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Project;
use App\Models\ProjectProgress;
use App\Models\File;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Perusahaan; 

class SiswaProjectProgressController extends Controller
{
   
    public function index() 
    {
        $user_id = Auth::id();

        $siswa = Siswa::where('id_user', $user_id)->first();
        if (!$siswa) {
            // Handle jika data siswa tidak ditemukan
            abort(403, 'Anda bukan siswa atau data siswa belum terdaftar.');
        }

        // Mengambil daftar id project yang diikuti oleh siswa dari tabel project_progress
        $projectIds = ProjectProgress::where('id_siswa', $siswa->id)
            ->distinct()
            ->pluck('id_project');

        // Mengambil daftar project berdasarkan id yang ditemukan dan hanya yang belum selesai
        $projects = Project::whereIn('id', $projectIds)
            ->where('status', '!=', 'selesai') // Tambahkan validasi untuk hanya menampilkan proyek yang belum selesai
            ->select('id', 'nama_project')
            ->get();
            
        // Mengambil riwayat progres yang telah diunggah oleh siswa
        // Menggunakan join untuk mendapatkan data yang relevan dari tabel lain
        $progressHistory = ProjectProgress::where('project_progress.id_siswa', $siswa->id)
            ->join('projects', 'project_progress.id_project', '=', 'projects.id')
            ->leftJoin('perusahaans', 'projects.id_perusahaan', '=', 'perusahaans.id_user')
            ->leftJoin('project_grades', function($join) use ($siswa) {
                $join->on('project_progress.id_project', '=', 'project_grades.id_project')
                     ->where('project_grades.id_siswa', '=', $siswa->id);
            })
            ->orderBy('project_progress.created_at', 'desc')
            ->select(
                'project_progress.tanggal',
                'projects.nama_project',
                'projects.status', // tambahkan ini biar status ada

                'perusahaans.nama as nama_perusahaan',
                'project_progress.progress_percent',
                'project_progress.deskripsi',
                'project_grades.feedback',
                'project_grades.nilai', // untuk menentukan status feedback
                'project_progress.file_id',
                'project_progress.id as progress_id'
            )
            ->get();

        // Mengirimkan data ke view
        return view('siswa.laporan', [
            'projects' => $projects,
            'progressHistory' => $progressHistory,
            'siswa' => $siswa,
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'deskripsi_progres' => 'nullable|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'file_upload' => 'nullable|file|max:2048', // Maksimum 2MB
        ]);

        $siswa = Siswa::where('id_user', Auth::id())->first();
        if (!$siswa) {
             abort(403, 'Anda bukan siswa atau data siswa belum terdaftar.');
        }

        $project = Project::find($request->project_id);
        
        if ($project && $project->status === 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat mengunggah progres untuk proyek yang sudah selesai.');
        }

        $lastProgress = ProjectProgress::where('id_siswa', $siswa->id)
            ->where('id_project', $request->project_id)
            ->max('progress_percent');

        if ($lastProgress !== null && $request->progress_percent < $lastProgress) {
            return redirect()->back()->with('error', 'Progres tidak boleh kurang dari ' . $lastProgress . '%.');
        }

        $fileId = null;
        if ($request->hasFile('file_upload')) {
            $uploadedFile = $request->file('file_upload');
            $path = $uploadedFile->store('public/project_files');
            
            $file = File::create([
                'nama_file' => $uploadedFile->getClientOriginalName(),
                'path' => $path, // Menyimpan jalur file yang dihasilkan oleh Laravel
                'file_type' => 'laporan', 
            ]);
            $fileId = $file->id;
        }

        ProjectProgress::create([
            'id_project' => $request->project_id,
            'id_siswa' => $siswa->id,
            'tanggal' => now(),
            'progress_percent' => $request->progress_percent,
            'deskripsi' => $request->deskripsi_progres,
            'file_id' => $fileId,
            'submitted_by' => $siswa->id, // Menggunakan ID siswa sebagai submitted_by
        ]);

        return redirect()->route('siswa.project_progress.index')->with('success', 'Laporan progres berhasil diunggah!');
    }

    /**
     * Mengunduh file laporan berdasarkan ID file.
     *
     * @param  \App\Models\File  $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(File $file): StreamedResponse
    {
        // Pastikan file_id ada, file tersebut ada di storage, dan jalurnya tidak kosong
        if (!empty($file->path) && Storage::exists($file->path)) {
            // Mengunduh file dengan nama aslinya
            return Storage::download($file->path, $file->nama_file);
        }

        // Jika file tidak ditemukan atau jalurnya kosong, arahkan kembali dengan pesan error
        return redirect()->back()->with('error', 'File tidak ditemukan atau jalur file tidak valid.');
    }
}
