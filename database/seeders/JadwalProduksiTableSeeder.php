<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalProduksiTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_produksi')->insert([
            [
                'id_project'   => 1,
                'id_kelasindustri' => 1,
                'tanggal_mulai'=> '2025-09-20',
                'tanggal_selesai'=> '2025-10-20',
                'jam_mulai'    => '08:00:00',
                'jam_selesai'  => '15:00:00',
                'catatan'      => 'Tahap awal produksi website',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_project'   => 2,
                'id_kelasindustri' => 1,
                'tanggal_mulai'=> '2025-09-25',
                'tanggal_selesai'=> '2025-11-15',
                'jam_mulai'    => '09:00:00',
                'jam_selesai'  => '17:00:00',
                'catatan'      => 'Pengembangan POS tahap 1',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
