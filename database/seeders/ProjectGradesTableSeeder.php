<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectGradesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_grades')->insert([
            [
                'id_project'       => 1,
                'id_siswa'         => 2,
                'nilai'            => 87.5,
                'feedback'         => 'Kerja bagus, tingkatkan dokumentasi.',
                'sertifikat_file_id'=> 3,
                'graded_by'        => 1,
                'graded_at'        => now(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_project'       => 2,
                'id_siswa'         => 4,
                'nilai'            => 90,
                'feedback'         => 'Sangat baik, sistem berjalan lancar.',
                'sertifikat_file_id'=> 4,
                'graded_by'        => 1,
                'graded_at'        => now(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
