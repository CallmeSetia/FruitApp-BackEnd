<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataProdukSeederRealZAJ extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = include(database_path('data_zaj/data_produk.php'));

        collect($data)->each(function ($produk) {
            DB::table('produk')->insert($produk);
        });
    }
}
