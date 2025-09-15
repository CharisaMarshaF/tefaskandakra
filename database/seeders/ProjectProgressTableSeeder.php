<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectProgressTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_progress')->insert([
            [
                'id_project'       => 1,
                'id_siswa'         => 2,
                'tanggal'          => now(),
                'progress_percent' => 50,
                'deskripsi'        => 'Landing page selesai',
                'file_id'          => 1,
                'submitted_by'     => 2,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_project'       => 1,
                'id_siswa'         => 3,
                'tanggal'          => now(),
                'progress_percent' => 80,
                'deskripsi'        => 'Integrasi backend selesai',
                'file_id'          => 2,
                'submitted_by'     => 3,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
