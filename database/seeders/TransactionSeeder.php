<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use Faker\Factory as Faker;
class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Assuming you have User and Product models with existing records
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        $userId = $faker->randomElement($users);
        $productId = $faker->randomElement($products);
        $quantity = $faker->numberBetween(1, 5);

        $transaction = Transaction::create(['date' => $faker->dateTimeBetween('-1 month', 'now')]);
        $transactionId = $transaction->id;

        $transactionDetails = TransactionDetail::create([
            'transaction_id' => $transactionId,
            'product_id' => $productId,
            'user_id' => $userId,
            'quantity' => $quantity,
        ]);

        Stock::where('product_id', $productId)
            ->decrement('quantity', $quantity);

    }
}
