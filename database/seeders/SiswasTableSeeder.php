<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswasTableSeeder extends Seeder
{
    public function run(): void
    {
        // Cari user role siswa
        DB::table('siswas')->insert([
            [
                'id_user'       => 6, // sesuaikan dengan id user siswa pertama
                'nis'           => '20250001',
                'nisn'          => '1234567890',
                'nama_lengkap'  => 'Budi',
                'gender'        => 'L',
                'tempat_lahir'  => 'Karanganyar',
                'tanggal_lahir' => '2007-05-15',
                'alamat'        => 'Jl. Pendidikan No. 1',
                'phone'         => '08123456789',
                'email'         => 'budi@example.com',
                'id_kelas'      => 1,
                'id_jurusan'    => 1,
                'angkatan'      => 2025,
                'status'        => 'aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
            // [
            //     'id_user'       => 10, // sesuaikan dengan id user siswa kedua
            //     'nis'           => '20250002',
            //     'nisn'          => '0987654321',
            //     'nama_lengkap'  => 'Sari',
            //     'gender'        => 'P',
            //     'tempat_lahir'  => 'Solo',
            //     'tanggal_lahir' => '2007-08-20',
            //     'alamat'        => 'Jl. Merdeka No. 2',
            //     'phone'         => '08987654321',
            //     'email'         => 'sari@example.com',
            //     'id_kelas'      => 1,
            //     'id_jurusan'    => 1,
            //     'angkatan'      => 2025,
            //     'status'        => 'aktif',
            //     'created_at'    => now(),
            //     'updated_at'    => now(),
            // ],
        ]);
    }
}
