<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('files')->insert([
            [
                'nama_file'   => 'Sertifikat Akreditasi.pdf',
                'file_type'   => 'sertifikat',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'Laporan Keuangan 2025.xlsx',
                'file_type'   => 'laporan',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'Surat Perjanjian.docx',
                'file_type'   => 'dokumen',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'laporan_progres_1.pdf',
                'file_type'   => 'laporan',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'laporan_progres_2.pdf',
                'file_type'   => 'laporan',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'sertifikat_project_1.pdf',
                'file_type'   => 'sertifikat',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'sertifikat_project_2.pdf',
                'file_type'   => 'sertifikat',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'Proposal Kerjasama.pdf',
                'file_type'   => 'dokumen',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'MOU Kerjasama.pdf',
                'file_type'   => 'dokumen',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'error-login.png',
                'file_type'   => 'gambar',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'log-upload.txt',
                'file_type'   => 'log',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_file'   => 'proposal-fitur.pdf',
                'file_type'   => 'dokumen',
                'uploaded_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
