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
                'id_user'       => 2,
                'kode_tiket'    => 'TKT-001',
                'subject'       => 'Error pada login',
                'message'       => 'Tidak bisa login setelah update terbaru.',
                'status'        => 'open', // ✅ sesuai enum
                'assigned_to'   => 1,
                'catatan_admin' => 'Akan ditindaklanjuti',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_user'       => 3,
                'kode_tiket'    => 'TKT-002',
                'subject'       => 'Masalah upload file',
                'message'       => 'Upload file sering gagal.',
                'status'        => 'in_progress', // ✅ sesuai enum
                'assigned_to'   => 1,
                'catatan_admin' => 'Sedang dianalisa',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_user'       => 4,
                'kode_tiket'    => 'TKT-003',
                'subject'       => 'Permintaan fitur baru',
                'message'       => 'Ingin menambahkan fitur laporan otomatis.',
                'status'        => 'closed', // ✅ sesuai enum
                'assigned_to'   => 1,
                'catatan_admin' => 'Sudah diselesaikan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
