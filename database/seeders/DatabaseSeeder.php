<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            JurusansTableSeeder::class,
            KelasTableSeeder::class,
            KelasIndustriTableSeeder::class,
            UsersTableSeeder::class,
            BahansTableSeeder::class,
            ProduksTableSeeder::class,
            GurusTableSeeder::class,
            SiswasTableSeeder::class,
            PerusahaansTableSeeder::class,

             // bagian transaksi
            FilesTableSeeder::class,
            OrdersTableSeeder::class,
            OrderItemsTableSeeder::class,
            PaymentsTableSeeder::class,
            ShipmentsTableSeeder::class,
            ProjectsTableSeeder::class,
            ProjectMembersTableSeeder::class,
            ProjectProgressTableSeeder::class,
            ProjectGradesTableSeeder::class,
            JadwalProduksiTableSeeder::class,
            CsTicketsTableSeeder::class,
            CooperationRequestsTableSeeder::class,
            TrackingLogsTableSeeder::class,
        ]);
    }
}
