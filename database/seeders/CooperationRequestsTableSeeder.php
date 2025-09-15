<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CooperationRequestsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cooperation_requests')->insert([
            [
                'nama_perusahaan' => 'PT Maju Jaya',
                'kode_tiket'      => 'CR-001',
                'alamat_perusahaan' => 'Jl. Industri No. 45',
                'bidang_usaha'    => 'Teknologi Informasi',
                'kontak_person'   => 'Budi Santoso',
                'no_telp'         => '081234567890',
                'email'           => 'budi@majujaya.com',
                'jenis_kerjasama' => 'Pengembangan aplikasi',
                'deskripsi_kebutuhan' => 'Aplikasi ERP sekolah',
                'status'          => 'pending',
                'catatan_admin'   => 'Menunggu konfirmasi',
                'tanggal_pengajuan'=> now(),
                'tanggal_update'  => now(),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
