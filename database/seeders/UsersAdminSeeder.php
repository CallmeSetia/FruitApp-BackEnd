<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $user_admin = User::create([
            'avatar' => $faker->imageUrl(),
            'address' => $faker->address,
            'age' => $faker->numberBetween(18, 60),
            'phone' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user_admin->addRole('admin');
    }
}
