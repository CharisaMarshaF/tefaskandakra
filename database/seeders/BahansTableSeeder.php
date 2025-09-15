<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahansTableSeeder extends Seeder
{
    public function run()
    {
        $bahan = [
            ['nama_bahan' => 'Kain Katun', 'stok' => 100, 'id_jurusan' => 3, 'kode_bahan' => 'KTN001'], // Tekstil
            ['nama_bahan' => 'Benang', 'stok' => 200, 'id_jurusan' => 3, 'kode_bahan' => 'BNG002'],      // Tekstil
            ['nama_bahan' => 'Besi', 'stok' => 50, 'id_jurusan' => 4, 'kode_bahan' => 'BSI003'],         // Mesin
            ['nama_bahan' => 'Baut', 'stok' => 500, 'id_jurusan' => 4, 'kode_bahan' => 'BUT004'],        // Mesin
        ];

        foreach ($bahan as $b) {
            DB::table('bahans')->insert([
                'nama_bahan' => $b['nama_bahan'],
                'stok' => $b['stok'],
                'id_jurusan' => $b['id_jurusan'],
                'kode_bahan' => $b['kode_bahan'], // Tambahkan baris ini
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}