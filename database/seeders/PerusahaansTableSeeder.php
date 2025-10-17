<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaansTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perusahaans')->insert([
            [
                'id_user'        => 8,
                'kode_perusahaan'=> 'PRSH-001',
                'nama'           => 'PT Industri Kreatif',
                'pic_name'       => 'Andi Firmansyah',
                'pic_phone'      => '081234567890',
                'pic_email'      => 'andi@industri.com',
                'alamat'         => 'Jl. Raya Industri No. 15',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // [
            //     'id_user'        => 8,
            //     'kode_perusahaan'=> 'PRSH-002',
            //     'nama'           => 'PT Teknologi Nusantara',
            //     'pic_name'       => 'Siti Rahma',
            //     'pic_phone'      => '082233445566',
            //     'pic_email'      => 'siti@teknologi.com',
            //     'alamat'         => 'Jl. Teknologi Baru No. 25',
            //     'created_at'     => now(),
            //     'updated_at'     => now(),
            // ],
        ]);
    }
}
