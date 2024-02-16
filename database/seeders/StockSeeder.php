<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Faker\Factory as Faker;
class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('stocks')->delete();

        // Assuming you have a Product model with existing products
        $products = Product::pluck('id')->toArray();

        foreach ($products as $productId) {
            DB::table('stocks')->insert([
                'product_id' => $productId,
                'quantity' => $faker->numberBetween(10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
