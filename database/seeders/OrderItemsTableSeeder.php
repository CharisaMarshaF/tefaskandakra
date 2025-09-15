<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'id_order' => 1,
                'id_produk' => 1, // produk pertama
                'qty' => 2,
                'price' => 50000.00,
                'subtotal' => 100000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 1,
                'id_produk' => 2, // produk kedua
                'qty' => 1,
                'price' => 50000.00,
                'subtotal' => 50000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'id_produk' => 2,
                'qty' => 5,
                'price' => 50000.00,
                'subtotal' => 250000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
