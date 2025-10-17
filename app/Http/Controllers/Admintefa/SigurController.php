<?php

namespace App\Http\Controllers\Admintefa;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\KelasIndustri;
use Illuminate\Support\Facades\Hash;

class SigurController extends Controller
{
    public function index()
    {
        $sigur = Siswa::all();
        $industri = KelasIndustri::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('admintefa.siswaguru', compact('sigur', 'industri', 'kelas', 'jurusan', 'guru'));
    }

    public function tambahGuru(Request $request)
    {
        // Buat email otomatis dari nama_lengkap
        $email = strtolower(str_replace(' ', '', $request->nama)) . '@gmail.com';

        // Simpan ke tabel users terlebih dahulu
        $user = User::create([
            'username' => $request->nama,
            'email' => $email,
            'password' => bcrypt('password'), // bisa ubah jadi password default lain
            'phone' => $request->phone ?? '-', // kalau input phone kosong
            'status' => 'active',
            'id_role' => 1,
        ]);

        // Setelah user berhasil dibuat, simpan ke tabel guru
        Guru::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'nip' => $request->nip,
            'id_jurusan' => $request->id_jurusan,
            'keahlian' => $request->keahlian,
            'jabatan' => $request->jabatan,
        ]);

        return back()->with('success', 'Data guru berhasil ditambahkan!');
    }


    public function tambahSiswa(Request $request)
    {
        Siswa::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'gender' => $request->gender,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_kelasindustri' => $request->id_kelasindustri,
            'id_kelas' => $request->id_kelas,
            'id_jurusan' => $request->id_jurusan,
            'angkatan' => $request->angkatan,
            'status' => 'aktif',
        ]);
        return back();
    }
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->update([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'gender' => $request->gender,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_kelasindustri' => $request->id_kelasindustri,
            'id_kelas' => $request->id_kelas,
            'id_jurusan' => $request->id_jurusan,
            'angkatan' => $request->angkatan,
            'status' => 'aktif',
        ]);
        return back();
    }
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return back();
    }
}
