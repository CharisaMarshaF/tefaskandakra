<?php

namespace App\Http\Controllers\waka;

use App\Http\Controllers\Controller;
use App\Models\ProjectGrade;
use App\Models\projects;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = projects::with('projectmember', 'projectmember.siswa')->get()->toArray();
        $grades = ProjectGrade::with(['project', 'siswa', 'siswa.kelas', 'grader', 'file'])->get()->toArray();
        return view('waka.sertifikat', compact('grades', 'projects'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'id_siswa' => 'required|exists:siswas,id',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
        ]);

        $fileId = null;

        if ($request->hasFile('sertifikat')) {
            $extension = $request->file('sertifikat')->getClientOriginalExtension();
            $fileName = now()->format('YmdHis') . '_' . $request->id_siswa . '.' . $extension;
            $path = $request->file('sertifikat')->storeAs('sertifikat', $fileName, 'public');

            $file = File::create([
                'nama_file' => $path,
                'file_type' => 'sertifikat',
            ]);
            $fileId = $file->id;
        }


        ProjectGrade::create([
            'id_project' => $request->id_project,
            'id_siswa' => $request->id_siswa,
            'nilai' => $request->nilai,
            'feedback' => $request->feedback,
            'sertifikat_file_id' => $fileId,
            'graded_by' => auth()->id(),
            'graded_at' => now(),
        ]);

        return back()->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $projectGrade = ProjectGrade::findOrFail($id);
        $request->validate([
            'nilai' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $fileId = $projectGrade->sertifikat_file_id;

        if ($request->hasFile('sertifikat')) {
            $extension = $request->file('sertifikat')->getClientOriginalExtension();
            $fileName = now()->format('YmdHis') . '_' . $projectGrade->id_siswa . '.' . $extension;
            $path = $request->file('sertifikat')->storeAs('sertifikat', $fileName, 'public');

            $file = File::create([
                'nama_file' => $path,
                'file_type' => 'sertifikat',
            ]);
            $fileId = $file->id;
        }


        $projectGrade->update([
            'nilai' => $request->nilai ?? $projectGrade->nilai,
            'feedback' => $request->feedback ?? $projectGrade->feedback,
            'sertifikat_file_id' => $fileId,
            'graded_by' => auth()->id(),
            'graded_at' => now(),
        ]);

        return back()->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $projectGrade = ProjectGrade::findOrFail($id);

        // hapus file sertifikat jika ada
        if ($projectGrade->sertifikat_file_id) {
            $file = File::find($projectGrade->sertifikat_file_id);
            if ($file) {
                Storage::disk('public')->delete($file->nama_file);
                $file->delete();
            }
        }

        $projectGrade->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus!');
    }
}
