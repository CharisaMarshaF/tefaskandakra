<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasIndustriTableSeeder extends Seeder
{
    public function run()
    {
        $kelasIndustri = [
            [
                'kode_kelas' => 'RPL-IND-01',
                'nama_kelas' => 'RPL Industri Batch 1',
                'id_jurusan' => 1,
                'angkatan'   => 2025,
                'kapasitas'  => 30,
            ],
            [
                'kode_kelas' => 'OTO-IND-01',
                'nama_kelas' => 'Ototronik Industri Batch 1',
                'id_jurusan' => 2,
                'angkatan'   => 2025,
                'kapasitas'  => 30,
            ],
        ];

        foreach ($kelasIndustri as $ki) {
            DB::table('kelas_industris')->insert([
                'kode_kelas' => $ki['kode_kelas'],
                'nama_kelas' => $ki['nama_kelas'],
                'id_jurusan' => $ki['id_jurusan'],
                'angkatan'   => $ki['angkatan'],
                'kapasitas'  => $ki['kapasitas'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
