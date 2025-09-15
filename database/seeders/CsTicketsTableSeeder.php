<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CsTicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cs_tickets')->insert([
            [
                'id_user'       => 2, // user pelapor
                'kode_tiket'    => 'TKT-001',
                'subject'       => 'Error pada login',
                'message'       => 'Tidak bisa login setelah update terbaru.',
                'status'        => 'open',
                'assigned_to'   => 1, // admin yang menangani
                'catatan_admin' => 'Akan ditindaklanjuti',
                'id_file'       => 10, // Relasi ke files.id
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_user'       => 3,
                'kode_tiket'    => 'TKT-002',
                'subject'       => 'Masalah upload file',
                'message'       => 'Upload file sering gagal.',
                'status'        => 'in_progress',
                'assigned_to'   => 1,
                'catatan_admin' => 'Sedang dianalisa',
                'id_file'       => 11, // Relasi ke files.id
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_user'       => 4,
                'kode_tiket'    => 'TKT-003',
                'subject'       => 'Permintaan fitur baru',
                'message'       => 'Ingin menambahkan fitur laporan otomatis.',
                'status'        => 'closed',
                'assigned_to'   => 1,
                'catatan_admin' => 'Sudah diselesaikan',
                'id_file'       => 12, // Relasi ke files.id
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
