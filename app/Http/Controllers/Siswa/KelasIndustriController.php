<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Lowongan;
use App\Models\PengajuanKelasIndustri;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class KelasIndustriController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data siswa berdasarkan user yang sedang login
        $siswa = DB::table('siswas')->where('id_user', $user->id)->first();

        // Cek apakah siswa sudah mengajukan kelas industri sebelumnya
        $sudahMengajukan = false;
        if ($siswa) {
            $sudahMengajukan = PengajuanKelasIndustri::where('id_siswa', $siswa->id)->exists();
        }

        $perusahaan = Perusahaan::with('lowongans')->get();

        return view('siswa.kelas_industri', compact('perusahaan', 'siswa', 'sudahMengajukan'));
    }

    /**
     * Ambil data detail lowongan via AJAX
     */
    public function detail($id)
    {
        // Ambil data lowongan beserta perusahaan dan posisi
        $lowongan = Lowongan::with(['perusahaan', 'posisis'])->findOrFail($id);

        return response()->json([
            'id' => $lowongan->id,
            'judul_lowongan' => $lowongan->judul_lowongan,
            'deskripsi' => $lowongan->deskripsi,
            'gambar' => $lowongan->gambar ? asset('storage/' . $lowongan->gambar) : null,
            'tanggal_mulai' => $lowongan->tanggal_mulai,
            'tanggal_selesai' => $lowongan->tanggal_selesai,

            // Data perusahaan
            'perusahaan' => [
                'nama' => $lowongan->perusahaan->nama ?? 'Tidak diketahui',
                'logo' => $lowongan->perusahaan && $lowongan->perusahaan->logo 
                            ? asset('storage/' . $lowongan->perusahaan->logo)
                            : asset('images/default-logo.png'),
            ],

            // Data posisi yang dibutuhkan
            'posisis' => $lowongan->posisis->map(function ($posisi) {
                return [
                    'id' => $posisi->id,
                    'nama_posisi' => $posisi->posisi,
                    'jumlah_dibutuhkan' => $posisi->jumlah_dibutuhkan,
                    'deskripsi' => $posisi->deskripsi,
                ];
            }),
        ]);
    }

    /**
     * Simpan pengajuan seleksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_lowongan' => 'required|exists:lowongans,id',
            'id_posisi' => 'required|exists:lowongan_posisis,id',
        ]);

        // Ambil data siswa yang sedang login
        $siswa = Siswa::where('id_user', Auth::id())->first();

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan. Pastikan akun siswa sudah terdaftar.'
            ], 404);
        }

        // Validasi hanya bisa mengajukan sekali saja
        $cekSudahMengajukan = PengajuanKelasIndustri::where('id_siswa', $siswa->id)->first();

        if ($cekSudahMengajukan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah pernah mengajukan ke kelas industri sebelumnya dan tidak bisa mengajukan lagi.'
            ], 422);
        }

        // Jika belum, simpan pengajuan
        PengajuanKelasIndustri::create([
            'id_siswa' => $siswa->id,
            'id_lowongan' => $request->id_lowongan,
            'id_posisi' => $request->id_posisi,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan berhasil diajukan! Tim akan segera memproses pengajuan Anda.',
        ]);
    }
}
