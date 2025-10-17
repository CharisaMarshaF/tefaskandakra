<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Project;
use App\Models\ProjectGrade;
use App\Models\Siswa;
use App\Models\File;

class SiswaNilaiProjectController extends Controller
{
    /**
     * Menampilkan halaman daftar nilai project siswa.
     * Mengambil semua nilai project yang terkait dengan siswa yang sedang login.
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil data siswa berdasarkan ID pengguna
        $siswa = Siswa::where('id_user', $userId)->first();

        // Jika data siswa tidak ditemukan, berikan pesan error
        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        // Mengambil semua nilai project yang terkait dengan siswa ini.
        // Eager loading relasi 'project' untuk menghindari N+1 query problem.
        $gradedProjects = ProjectGrade::where('id_siswa', $siswa->id)
    ->with(['project.perusahaan','project.members','project.grades','project.memberProgress','sertifikatFile'])
    ->get();


        // Inisialisasi variabel untuk ringkasan data
        $totalProjectsSelesai = 0;
        $totalNilai = 0;
        $jumlahProyekDinilai = 0;
        $gradeTertinggi = null;
        $namaProjectTertinggi = '';

        foreach ($gradedProjects as $grade) {
            $nilaiRataRata = null;
            $gradeHuruf = '';
            
            // Mengambil semua nilai aspek dari proyek ini untuk menghitung rata-rata
            // Catatan: Asumsi setiap `ProjectGrade` adalah nilai akhir.
            // Jika ada aspek lain, perlu disesuaikan.
            // Aspek nilai seperti "Pengetahuan" dan "Kreatifitas" pada view tidak ada di skema,
            // jadi nilai yang ditampilkan adalah nilai dari `project_grades.nilai`.
            if ($grade->nilai) {
                $nilaiRataRata = $grade->nilai;
                $totalNilai += $nilaiRataRata;
                $jumlahProyekDinilai++;

                // Menentukan grade berdasarkan nilai rata-rata
                $gradeHuruf = $this->getGradeHuruf($nilaiRataRata);

                // Menemukan grade tertinggi
                if ($gradeTertinggi === null || $nilaiRataRata > $gradeTertinggi) {
                    $gradeTertinggi = $nilaiRataRata;
                    $namaProjectTertinggi = $grade->project->nama_project;
                }
            }

            // Memeriksa status proyek
            if ($grade->project->status === 'selesai') {
                $totalProjectsSelesai++;
            }
            
            // Tambahkan data rata-rata dan grade ke objek
            $grade->nilai_rata_rata = $nilaiRataRata;
            $grade->grade_huruf = $gradeHuruf;
        }

        // Menghitung rata-rata nilai keseluruhan
        $rataRataKeseluruhan = ($jumlahProyekDinilai > 0) ? $totalNilai / $jumlahProyekDinilai : 0;
        
        // Asumsi "Project sedang berjalan" adalah proyek yang belum berstatus 'selesai' dan siswa adalah anggota
        $proyekBerjalan = $siswa->projects()->where('status', '!=', 'selesai')->count();
        $proyekSelesai = $siswa->projects()->where('status', 'selesai')->count();

        // Mengirimkan data ke view
        return view('siswa.nilai_project', [
            'gradedProjects' => $gradedProjects,
            'rataRataKeseluruhan' => number_format($rataRataKeseluruhan, 2),
            'totalProjectsSelesai' => $proyekSelesai,
            'proyekBerjalan' => $proyekBerjalan,
            'gradeTertinggi' => $this->getGradeHuruf($gradeTertinggi),
            'namaProjectTertinggi' => $namaProjectTertinggi,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Mengunduh file sertifikat berdasarkan ID file.
     * Menggunakan Route Model Binding untuk mendapatkan model File.
     *
     * @param  \App\Models\File  $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function download(File $file): StreamedResponse|\Illuminate\Http\RedirectResponse
    {
        if (Storage::exists($file->path)) {
            // Pastikan file tersebut adalah sertifikat dan milik siswa yang sedang login.
            $isCertificate = ProjectGrade::where('sertifikat_file_id', $file->id)
                ->where('id_siswa', Auth::user()->siswa->id)
                ->exists();

            if ($isCertificate) {
                return Storage::download($file->path, $file->nama_file);
            }
            
            // Jika bukan sertifikat atau bukan milik siswa, berikan pesan error
            return redirect()->back()->with('error', 'Akses ditolak. File ini tidak tersedia untuk Anda.');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan atau tidak valid.');
    }
    
    /**
     * Helper function untuk menentukan grade huruf.
     * Dapat disesuaikan sesuai kebutuhan.
     */
    private function getGradeHuruf($nilai)
    {
        if ($nilai >= 90) {
            return 'A+';
        } elseif ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B+';
        } elseif ($nilai >= 75) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C+';
        } else {
            return 'C';
        }
    }
}
