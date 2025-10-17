<?php

namespace App\Http\Controllers\Guru;

use App\Models\File;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Projects;
use App\Models\Perusahaan;
use App\Models\ProjectGrade;
use Illuminate\Http\Request;
use App\Models\KelasIndustri;
use App\Models\ProjectProgress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function kelola()
    {
        $projects = Projects::with([
            'members.siswa',
            'perusahaan',
            'progress' => function ($query) {
                $query->latest()->limit(1);
            }
        ])->get();

        return view('guru.kelola', compact('projects'));
    }

    public function showDetailProject(Projects $project)
    {
        $project->load([
            'perusahaan',
            'jurusan',
            'kelasindustri',
            'members.siswa',
            'progress' => fn($q) => $q->latest('tanggal')
        ]);

        $latestProgress = $project->progress->first();
        $progressPercent = $latestProgress ? $latestProgress->progress_percent : 0;

        return view('guru.detail_project', compact('project', 'progressPercent'));
    }

    public function nilai()
    {
        $projects = Projects::all();
        $students = Siswa::with('user')->get();

        return view('guru.nilai', compact('projects', 'students'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'kreativitas' => 'nullable|numeric|min:0|max:100',
            'kerjasama_tim' => 'nullable|numeric|min:0|max:100',
            'ketepatan_waktu' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        // Hitung nilai rata-rata
        $nilai = collect([
            $request->kreativitas,
            $request->kerjasama_tim,
            $request->ketepatan_waktu
        ])->filter()->avg();

        ProjectGrade::create([
            'id_project' => $request->id_project,
            'id_siswa' => $request->id_siswa,
            'nilai' => $nilai,
            'feedback' => $request->feedback,
            'graded_by' => Auth::id(),
            'graded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

    public function prosesProduksi()
    {
        $students = Siswa::with('user')->get();

        $projects = Projects::with('members')
            ->withCount('progress')
            ->with(['progress' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get();

        return view('guru.prosesProduksi', compact('students', 'projects'));
    }

    public function storeProgress(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'id_siswa' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'progress_percent' => 'required|integer|min:0|max:100',
            'file' => 'nullable|file|max:2048',
        ]);

        $fileId = null;

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $path = $uploadedFile->store('progress_files', 'public');

            $file = File::create([
                'nama_file' => $uploadedFile->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => 'laporan',
            ]);

            $fileId = $file->id;
        }

        ProjectProgress::create([
            'id_project' => $request->id_project,
            'id_siswa' => $request->id_siswa,
            'tanggal' => $request->tanggal,
            'progress_percent' => $request->progress_percent,
            'deskripsi' => $request->deskripsi,
            'file_id' => $fileId,
            'submitted_by' => Auth::id(),
        ]);

        return redirect()->route('prosesProduksi')->with('success', 'Progress berhasil disimpan!');
    }

    public function projectTefa()
    {
        $gurus = Guru::with('user')->get();
        $jurusans = Jurusan::all();
        $kelasIndustri = KelasIndustri::all();
        $perusahaans = Perusahaan::with('user')->get();
        $projects = Projects::select('id', 'kode_project', 'nama_project', 'start_date', 'deadline')->get();

        return view('guru.forminput', compact('gurus', 'jurusans', 'kelasIndustri', 'perusahaans', 'projects'));
    }

    public function projectStore(Request $request)
    {
        $request->validate([
            'nama_project' => 'required|string|max:150',
            'id_guru' => 'required|exists:users,id',
            'id_perusahaan' => 'required|exists:users,id',
            'id_jurusan' => 'required|exists:jurusans,id',
            'id_kelasindustri' => 'required|exists:kelas_industris,id',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'deskripsi' => 'nullable|string',
            'expected_output' => 'nullable|string',
        ]);

        $lastProject = Projects::orderBy('id', 'desc')->first();

        if ($lastProject) {
            $lastNumber = (int) filter_var($lastProject->kode_project, FILTER_SANITIZE_NUMBER_INT);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeProject = 'PRJ-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Projects::create([
            'kode_project' => $kodeProject,
            'nama_project' => $request->nama_project,
            'deskripsi' => $request->deskripsi,
            'id_guru' => $request->id_guru,
            'id_perusahaan' => $request->id_perusahaan,
            'id_jurusan' => $request->id_jurusan,
            'id_kelasindustri' => $request->id_kelasindustri,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
            'status' => 'draft',
            'expected_output' => $request->expected_output,
        ]);

        return redirect()->route('kelola')->with('success', "Project {$request->nama_project} berhasil dibuat dengan kode {$kodeProject}!");
    }

    public function updateDeadline(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'new_deadline' => 'required|date|after_or_equal:start_date',
        ]);

        $project = Projects::findOrFail($request->id_project);

        $project->update([
            'deadline' => $request->new_deadline,
        ]);

        return redirect()->back()->with('success', 'Deadline project berhasil diperbarui.');
    }
}
