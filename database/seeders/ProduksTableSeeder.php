<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            ['nama_produk' => 'Aplikasi POS', 'id_jurusan' => 1, 'id_foto' => null, 'kode_produk' => 'RPL001', 'harga' => 500000.00],
            ['nama_produk' => 'Simulasi Ototronik', 'id_jurusan' => 2, 'id_foto' => null, 'kode_produk' => 'OTO001', 'harga' => 250000.00],
            ['nama_produk' => 'Kain Batik', 'id_jurusan' => 3, 'id_foto' => null, 'kode_produk' => 'TEK001', 'harga' => 75000.50],
            ['nama_produk' => 'Komponen Mesin', 'id_jurusan' => 4, 'id_foto' => null, 'kode_produk' => 'MES001', 'harga' => 12500.00],
        ];

        foreach ($produks as $produk) {
            DB::table('produks')->insert([
                'nama_produk' => $produk['nama_produk'],
                'id_jurusan' => $produk['id_jurusan'],
                'id_foto' => $produk['id_foto'],
                'kode_produk' => $produk['kode_produk'], // Tambahkan ini
                'harga' => $produk['harga'],             // Tambahkan ini
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
