<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));
        Product::create([
            'kode' => $faker->unique()->ean13,
            'nama_produk' => $faker->randomElement([$faker->fruitName(), $faker->foodName(), $faker->vegetableName()]),
            'description' => $faker->sentence,
            'satuan' => $faker->randomElement(['kg', 'piece', 'box']),
            'harga' => $faker->numberBetween(10000, 100000), // Adjust the range as needed
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
