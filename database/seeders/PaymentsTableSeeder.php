<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id_order' => 1,
                'metode' => 'Transfer Bank',
                'amount' => 150000.00,
                'bukti_file_id' => 1, // referensi ke tabel files
                'verified_by' => 1, // Admin TEFA sebagai verifikator
                'status' => 'pending',
                'verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'metode' => 'Transfer Bank',
                'amount' => 250000.00,
                'bukti_file_id' => 2,
                'verified_by' => 1,
                'status' => 'diterima',
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
