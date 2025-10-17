<?php

namespace App\Http\Controllers\waka;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\KelasIndustri;
use App\Models\Perusahaan;
use App\Models\projects;
use Illuminate\Http\Request;

class JadwalKelasIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $DataJurusan = Jurusan::all();

        $GuruPendamping = Guru::all();
        $Perusahaan = Perusahaan::all();
        $KelasIndustri = KelasIndustri::all();

        $jadwal = Projects::with(['jurusan', 'guru', 'perusahaan', 'kelasindustri'])
            ->when($search, function ($q) use ($search) {
                $q->where('nama_project', 'like', "%$search%")
                    ->orWhere('kode_project', 'like', "%$search%");
            })
            ->get();
        return view('waka.JadwalKelasIndustri', [
            'jurusan' => $DataJurusan,
            'data' => $jadwal,
            'search' => $search,
            'guru' => $GuruPendamping,
            'perusahaan' => $Perusahaan,
            'kelasindustri' => $KelasIndustri,
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Projects::with([
            'jurusan:id,nama_jurusan',
            'guru:id,nama',
            'perusahaan:id,nama',
            'kelasindustri:id,nama_kelas',
            'projectmember.siswa:id,nama_lengkap',
        ])->findOrFail($id);
        return view('waka.DetailJadwalIndustri', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_project' => 'required|unique:projects,kode_project',
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'id_guru' => 'required|integer',
            'id_perusahaan' => 'required|integer',
            'id_jurusan' => 'required|integer',
            'id_kelasindustri' => 'required|integer',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:draft,pending,proses,selesai,dibatalkan',
            'expected_output' => 'nullable|string',
        ], [
            'kode_project.required' => 'Kode projek wajib diisi.',
            'kode_project.unique' => 'Kode projek sudah digunakan.',
            'nama_project.required' => 'Nama projek wajib diisi.',
        ]);

        Projects::create($request->only([
            'kode_project',
            'nama_project',
            'deskripsi',
            'id_guru',
            'id_perusahaan',
            'id_jurusan',
            'id_kelasindustri',
            'start_date',
            'deadline',
            'status',
            'expected_output'
        ]));

        return back()->with('success', 'Projek berhasil ditambahkan!');
    }
    public function update(Request $request, string $id)
    {
        $project = Projects::findOrFail($id);

        $request->validate([
            'kode_project' => 'required|unique:projects,kode_project,' . $id,
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'id_guru' => 'nullable|integer',
            'id_perusahaan' => 'nullable|integer',
            'id_jurusan' => 'nullable|integer',
            'id_kelasindustri' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:draft,pending,proses,selesai,dibatalkan',
            'expected_output' => 'nullable|string',
        ]);

        $data = array_filter($request->only([
            'kode_project',
            'nama_project',
            'deskripsi',
            'id_guru',
            'id_perusahaan',
            'id_jurusan',
            'id_kelasindustri',
            'start_date',
            'deadline',
            'status',
            'expected_output'
        ]), fn($v) => $v !== null && $v !== '');

        $project->update($data);

        return back()->with('success', 'Projek berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return back()->with('success', 'Projek berhasil dihapus!');
    }

}
