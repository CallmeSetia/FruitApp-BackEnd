<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
$faker = Faker::create();
class UserDefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $user_superadmin = User::create([
            'avatar' => $faker->imageUrl(),
            'address' => $faker->address,
            'age' => $faker->numberBetween(18, 60),
            'phone' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'name' => $faker->name,
            'username' => 'superuser',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user_superadmin->addRole('superuser');

        $user_admin = User::create([
            'avatar' => $faker->imageUrl(),
            'address' => $faker->address,
            'age' => $faker->numberBetween(18, 60),
            'phone' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'name' => $faker->name,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user_admin->addRole('admin');
    }
}
