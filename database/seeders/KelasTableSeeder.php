<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasTableSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            ['nama_kelas' => 'X RPL A', 'id_jurusan' => 1, 'angkatan' => 2025],
            ['nama_kelas' => 'XI RPL B', 'id_jurusan' => 1, 'angkatan' => 2024],
            ['nama_kelas' => 'XII RPL C', 'id_jurusan' => 1, 'angkatan' => 2023],
            ['nama_kelas' => 'X Ototronik A', 'id_jurusan' => 2, 'angkatan' => 2025],
            ['nama_kelas' => 'XI Tekstil B', 'id_jurusan' => 3, 'angkatan' => 2024],
            ['nama_kelas' => 'XII Mesin C', 'id_jurusan' => 4, 'angkatan' => 2023],
        ];

        foreach ($kelas as $k) {
            DB::table('kelas')->insert([
                'nama_kelas' => $k['nama_kelas'],
                'id_jurusan' => $k['id_jurusan'],
                'angkatan'   => $k['angkatan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
