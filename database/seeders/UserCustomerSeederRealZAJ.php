<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserCustomerSeederRealZAJ extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_users = include(database_path('data_zaj/data_users_customer.php'));
        $data_customers = include(database_path('data_zaj/data_customers.php'));

        $faker = Faker::create();

        foreach ($data_users as $userData) {
            $user = User::create([
                'avatar' => $faker->imageUrl(200, 200),
                'name' => $userData['nama'],
                'username' => $userData['username'],
                'password' => $userData['password'],
                'email' => null,
                'email_verified_at' => null,
                'is_customer' => 1

            ]);
            $user->addRole('customer');

            $userId = $user->id;
            $customerData = array_values(array_filter($data_customers, function ($data) use ($userData) {
                return $data['users_id'] == $userData['id'];
            }));

            if (!empty($customerData)) {
                foreach ($customerData as $customer) {
                    $user->customer()->create([
                        'user_id' => $userId,
                        'address' => $customer['alamat'],
                        'age' =>  '',
                        'phone' => $customer['no_telepon'],
                        'gender' => null,
                        'nomor_identitas' => $customer['nomor_identitas'],
                        'foto_identitas' => $customer['foto_identitas'],
                        'email' =>  $customer['email'],
                        'identitas_type' => $customer['identitas_type'],
                        'keterangan' => $customer['keterangan'],
                        'limit_pinjaman' => (float) $customer['limit_pinjaman'],
                    ]);
                }
            }
        }
    }
}
