<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusansTableSeeder extends Seeder
{
    public function run()
    {
        $jurusans = [
            ['nama_jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            ['nama_jurusan' => 'Ototronik'],
            ['nama_jurusan' => 'Tekstil'],
            ['nama_jurusan' => 'Mesin'],
        ];

        foreach ($jurusans as $jurusan) {
            DB::table('jurusans')->insert([
                'nama_jurusan' => $jurusan['nama_jurusan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
