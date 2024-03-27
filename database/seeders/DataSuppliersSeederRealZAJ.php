<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSuppliersSeederRealZAJ extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = include(database_path('data_zaj/data_suppliers.php'));

        collect($data)->each(function ($produk) {
            DB::table('suppliers')->insert($produk);
        });
    }
}
