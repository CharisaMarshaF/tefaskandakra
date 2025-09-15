<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'order_no' => 'ORD-001',
                'id_user' => 9, // Customer (pastikan user dengan role customer ada di seeder sebelumnya)
                'total' => 150000.00,
                'shipping_address' => 'Jl. Merdeka No. 1, Karanganyar',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_no' => 'ORD-002',
                'id_user' => 9,
                'total' => 250000.00,
                'shipping_address' => 'Jl. Raya Solo-Sragen No. 5',
                'status' => 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
