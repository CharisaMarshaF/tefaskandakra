<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Perusahaan;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index()
    {
        // Data untuk kartu statistik di atas
        $totalJurusan = Jurusan::count();
        $totalProject = Project::count();
        $totalGuru = Guru::count();
        $mitraDUDI = Perusahaan::count();

        // Mengambil semua jurusan beserta relasi project dan perusahaan mitranya
        // Eager loading untuk efisiensi query
        $jurusans = Jurusan::with(['projects.perusahaan'])->withCount('projects')->get();

        return view('AdminSekolah.jurusan', compact(
            'totalJurusan',
            'totalProject',
            'totalGuru',
            'mitraDUDI',
            'jurusans'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:100|unique:jurusans',
            'kode_jurusan' => 'nullable|string|max:10',
            'kepala_jurusan' => 'nullable|string|max:150',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataPath = [];
        if ($request->hasFile('foto')) {
            $dataPath['foto'] = $request->file('foto')->store('public/jurusan');
        }

        Jurusan::create(array_merge($request->only('nama_jurusan', 'kode_jurusan', 'kepala_jurusan', 'deskripsi')));

        return response()->json(['success' => 'Jurusan berhasil ditambahkan!']);
    }

    // [BARU] Method untuk mengambil data edit
    public function edit(Jurusan $jurusan)
    {
        return response()->json($jurusan);
    }

    // [BARU] Method untuk memperbarui jurusan
    public function update(Request $request, Jurusan $jurusan)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan,' . $jurusan->id,
            'kode_jurusan' => 'nullable|string|max:10',
            'kepala_jurusan' => 'nullable|string|max:150',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataPath = $request->only('nama_jurusan', 'kode_jurusan', 'kepala_jurusan', 'deskripsi');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($jurusan->foto) {
                Storage::delete($jurusan->foto);
            }
            $dataPath['foto'] = $request->file('foto')->store('public/jurusan');
        }

        $jurusan->update($dataPath);

        return response()->json(['success' => 'Jurusan berhasil diperbarui!']);
    }

    // [BARU] Method untuk menghapus jurusan
    public function destroy(Jurusan $jurusan)
    {
        try {
            // Hapus foto terkait jika ada
            if ($jurusan->foto) {
                Storage::delete($jurusan->foto);
            }
            $jurusan->delete();
            return response()->json(['success' => 'Jurusan berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data.'], 500);
        }
    }
}
