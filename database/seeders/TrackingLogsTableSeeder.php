<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackingLogsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tracking_logs')->insert([
            [
                'id_ticket'    => 1,
                'id_req'       => null,
                'status'       => 'ditindaklanjuti',
                'keterangan'   => 'Sudah direspon oleh CS',
                'changed_by'   => 1,
                'changed_at'   => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_ticket'    => null,
                'id_req'       => 1,
                'status'       => 'menunggu',
                'keterangan'   => 'Menunggu persetujuan kerjasama',
                'changed_by'   => 1,
                'changed_at'   => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
