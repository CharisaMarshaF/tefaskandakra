<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LowonganPosisisTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('lowongan_posisis')->insert([
            [
                'id_lowongan' => 1,
                'posisi' => 'Web Developer',
                'jumlah_dibutuhkan' => 3,
                'deskripsi' => 'Membangun dan memelihara website perusahaan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_lowongan' => 1,
                'posisi' => 'UI/UX Designer',
                'jumlah_dibutuhkan' => 2,
                'deskripsi' => 'Merancang tampilan aplikasi yang menarik.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

    