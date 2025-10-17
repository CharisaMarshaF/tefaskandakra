<?php

namespace App\Http\Controllers\waka;

use App\Http\Controllers\Controller;
use App\Models\ProjectGrade;
use App\Models\projects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiProjectController extends Controller
{
    public function index()
    {
        $projects = projects::with('projectmember', 'projectmember.siswa')->get()->toArray();
        $grades = ProjectGrade::with(['project', 'siswa', 'siswa.kelas', 'grader'])->get()->toArray();
        return view('waka/nilai_projek', compact('grades', 'projects'));
    }

    public function create()
    {
        return view('waka/nilai_projek');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'id_siswa' => 'required|exists:users,id',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        ProjectGrade::create([
            'id_project' => $request->id_project,
            'id_siswa' => $request->id_siswa,
            'nilai' => $request->nilai,
            'feedback' => $request->feedback,
            'graded_by' => Auth::id(),
            'graded_at' => Carbon::now(),
        ]);

        return redirect('waka/nilai')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit(ProjectGrade $grade)
    {
        return view('waka/nilai_projek', compact('grade'));
    }

    public function update(Request $request, string $id)
    {
        $grade = ProjectGrade::findOrFail($id);
        $request->validate([
            'nilai' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $grade->update([
            'nilai' => $request->nilai,
            'feedback' => $request->feedback,
            'graded_by' => Auth::id(),
            'graded_at' => Carbon::now(),
        ]);
        return redirect('waka/nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $grade = ProjectGrade::findOrFail($id);
        $grade->delete();
        return redirect('waka/nilai')->with('success', 'Nilai berhasil dihapus.');
    }
}
