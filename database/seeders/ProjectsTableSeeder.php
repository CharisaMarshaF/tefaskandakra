<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'kode_project'   => 'PRJ-001',
                'nama_project'   => 'Website Showcase SMK',
                'deskripsi'      => 'Website untuk menampilkan karya siswa dan prestasi sekolah.',
                'id_guru'        => 1,
                'id_perusahaan'  => 1,
                'id_jurusan'     => 1,
                'id_kelasindustri'=> 1,
                'start_date'     => '2025-09-01',
                'deadline'       => '2025-12-01',
                'status'         => 'draft',
                'expected_output'=> 'Website siap launching',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'kode_project'   => 'PRJ-002',
                'nama_project'   => 'Aplikasi Point of Sales',
                'deskripsi'      => 'Aplikasi kasir untuk toko kelontong berbasis web.',
                'id_guru'        => 1,
                'id_perusahaan'  => 2,
                'id_jurusan'     => 1,
                'id_kelasindustri'=> 1,
                'start_date'     => '2025-09-10',
                'deadline'       => '2025-12-15',
                'status'         => 'pending',
                'expected_output'=> 'Sistem kasir lengkap',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
