<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // Admin TEFA
            ['username' => 'Admin TEFA', 'email' => 'admin.tefa@smkn2kra.sch.id', 'password' => Hash::make('password'), 'id_role' => 1],

            // Admin Sekolah
            ['username' => 'Admin Sekolah', 'email' => 'admin.sekolah@smkn2kra.sch.id', 'password' => Hash::make('password'), 'id_role' => 2],

            // Waka Kurikulum
            ['username' => 'Waka Kurikulum', 'email' => 'waka.kurikulum@smkn2kra.sch.id', 'password' => Hash::make('password'), 'id_role' => 3],

            // Guru Pembimbing
            ['username' => 'Guru Pembimbing', 'email' => 'guru@smkn2kra.sch.id', 'password' => Hash::make('password'), 'id_role' => 4],

            // Kepala Sekolah
            ['username' => 'Kepala Sekolah', 'email' => 'kepsek@smkn2kra.sch.id', 'password' => Hash::make('password'), 'id_role' => 5],

            // Siswa - Login menggunakan NIS (dimasukkan di kolom 'email')
            ['username' => 'Budi', 'email' => '20250001', 'password' => Hash::make('20250001'), 'id_role' => 6],

            // Orang Tua
            ['username' => 'Orang Tua Budi', 'email' => 'ortu.budi', 'password' => Hash::make('password'), 'id_role' => 7],

            // Perusahaan
            ['username' => 'PT Industri Kreatif', 'email' => 'pt.industri@gmail.com', 'password' => Hash::make('password'), 'id_role' => 8],

            // Customer
            ['username' => 'Customer Umum', 'email' => 'customer@gmail.com', 'password' => Hash::make('password'), 'id_role' => 9],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'id_role' => $user['id_role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
