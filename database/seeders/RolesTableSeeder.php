<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Admin TEFA'],
            ['name' => 'Admin Sekolah'],
            ['name' => 'Waka Kurikulum'],
            ['name' => 'Guru Pembimbing'],
            ['name' => 'Kepala Sekolah'],
            ['name' => 'Siswa'],
            ['name' => 'Orang Tua'],
            ['name' => 'Perusahaan'],
            ['name' => 'Customer'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
