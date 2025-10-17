<?php

namespace App\Http\Controllers\waka;

use App\Http\Controllers\Controller;
use App\Models\KelasIndustri;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKelasIndustri = KelasIndustri::count();

        $jumlahSiswa = Siswa::whereNotNull('kelas_industri_id')->count();

        $jumlahOutcome = Outcome::count();

        $jumlahMitra = Mitra::count();

        $kelasPerJurusan = KelasIndustri::selectRaw('jurusan, COUNT(*) as total')
            ->groupBy('jurusan')
            ->pluck('total', 'jurusan');

        $siswaPerJurusan = Siswa::selectRaw('jurusan, COUNT(*) as total')
            ->groupBy('jurusan')
            ->pluck('total', 'jurusan');

        return view('waka.dashboard', compact(
            'jumlahKelasIndustri',
            'jumlahSiswa',
            'jumlahOutcome',
            'jumlahMitra',
            'kelasPerJurusan',
            'siswaPerJurusan'
        ));
    }
}
