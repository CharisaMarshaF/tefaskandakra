<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GurusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nip' => '1980010120', // Sample NIP (Nomor Induk Pegawai)
                'nama' => 'Dwi Nuryani S.Kom',
                'id_jurusan' => 1, // Assuming '1' corresponds to a valid jurusan in the 'jurusans' table
                'keahlian' => 'Banyak',
                'jabatan' => 'Kepala Sekolah',
                'id_user' => 4, // Assumes the 'Guru Pembimbing' user has id_user = 4
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more teacher data here if needed
        ];

        foreach ($gurus as $guru) {
            DB::table('gurus')->insert($guru);
        }
    }
}
