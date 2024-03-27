<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'avatar' => $faker->imageUrl(200, 200),
                'name' => $faker->name,
                'username' => $faker->unique()->userName,
                'password' => Hash::make('password'),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
//            'remember_token' => Str::random(10),
            ]);
            $user->addRole('customer');

            $user->customer()->create([
                'address' => $faker->address,
                'age' => $faker->numberBetween(18, 60),
                'phone' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female']),
                'nomor_identitas' => $faker->ean13,
                'foto_identitas' => $faker->imageUrl(),
                'email' => $faker->unique()->safeEmail,
                'identitas_type' => $faker->randomElement(['KTP', 'SIM', 'Passport']),
                'keterangan' => $faker->sentence,
                'limit_pinjaman' => 0,
            ]);
        }

    }
}
