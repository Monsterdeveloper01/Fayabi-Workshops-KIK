<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun ADMIN
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@motoshop.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // passwordnya 'password'
        ]);

        // 2. Akun VENDOR (Penjual)
        User::create([
            'name' => 'Vendor Knalpot',
            'email' => 'vendor@motoshop.com',
            'role' => 'vendor',
            'password' => Hash::make('password'),
        ]);

        // 3. Akun USER (Pembeli Biasa)
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@motoshop.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}