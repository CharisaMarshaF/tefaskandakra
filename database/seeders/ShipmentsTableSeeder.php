<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('shipments')->insert([
            [
                'id_order' => 1,
                'courier' => 'JNE',
                'tracking_no' => 'JNE123456789',
                'status' => 'packed',
                'packed_by' => 1, // Admin TEFA
                'shipped_at' => now(),
                'delivered_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'courier' => 'SiCepat',
                'tracking_no' => 'SCP987654321',
                'status' => 'delivered',
                'packed_by' => 1,
                'shipped_at' => now()->subDays(2),
                'delivered_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
