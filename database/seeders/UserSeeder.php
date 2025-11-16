<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'username' => 'admin',
            'email' => 'admin@tokokes.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'gender' => 'male',
            'address' => 'Jl. Admin No. 1',
            'city' => 'Jakarta',
            'contact_no' => '081234567890',
        ]);

        // Customer Users
        User::create([
            'username' => 'customer1',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'gender' => 'female',
            'date_of_birth' => '1990-05-15',
            'address' => 'Jl. Customer No. 10',
            'city' => 'Surabaya',
            'contact_no' => '081298765432',
            'paypal_id' => 'customer1@paypal.com',
        ]);

        User::create([
            'username' => 'customer2',
            'email' => 'customer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'gender' => 'male',
            'date_of_birth' => '1985-08-20',
            'address' => 'Jl. Pelanggan No. 25',
            'city' => 'Bandung',
            'contact_no' => '081234509876',
        ]);
    }
}