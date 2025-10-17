<?php

namespace App\Http\Controllers\waka;

use App\Http\Controllers\Controller;
use App\Models\JadwalProduksi;
use App\Models\KelasIndustri;
use App\Models\projects;
use Illuminate\Http\Request;

class JadwalProduksiTefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = projects::all()->toArray();
        $kelasindustri = KelasIndustri::all()->toArray();
        $jadwal = JadwalProduksi::with('project.jurusan', 'project.guru', 'project.perusahaan', 'kelasindustri')
            ->get()->toArray();

        return view('waka.JadwalTefa', [
            'jadwal' => $jadwal,
            'projects' => $projects,
            'kelasindustri' => $kelasindustri,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'id_kelasindustri' => 'required|exists:kelas_industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalProduksi::create([
            'id_project' => $request->id_project,
            'id_kelasindustri' => $request->id_kelasindustri,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('jadwal-tefa.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id',
            'id_kelasindustri' => 'required|exists:kelas_industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalProduksi::findOrFail($id);

        $jadwal->update([
            'id_project' => $request->id_project,
            'id_kelasindustri' => $request->id_kelasindustri,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('jadwal-tefa.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalProduksi::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal-tefa.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
