<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectMembersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_members')->insert([
            [
                'id_project'  => 1,
                'id_siswa'    => 2,
                'role'        => 'Frontend Developer',
                'assigned_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_project'  => 1,
                'id_siswa'    => 2,
                'role'        => 'Backend Developer',
                'assigned_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_project'  => 2,
                'id_siswa'    => 4,
                'role'        => 'Fullstack Developer',
                'assigned_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
