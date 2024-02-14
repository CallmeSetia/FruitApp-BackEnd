<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user_superadmin = User::create([
            'name' => 'superadmin',
            'username' => 'super',
            'password' => Hash::make('super'),
        ]);
        $user_superadmin->addRole('superuser');

        $user_admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        $user_admin->addRole('admin');
    }
}
