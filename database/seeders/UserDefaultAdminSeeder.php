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
            'avatar' => $faker->imageUrl(200, 200),
            'name' => $faker->name,
            'username' => $faker->unique()->userName,
            'password' => Hash::make('password'),
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_customer' => false,
//            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user_superadmin->addRole('superuser');

        $user_admin = User::create([
            'avatar' => $faker->imageUrl(200, 200),
            'name' => $faker->name,
            'username' => $faker->unique()->userName,
            'password' => Hash::make('password'),
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_customer' => false,
//            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user_admin->addRole('admin');
    }
}
