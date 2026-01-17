<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category; // Jangan lupa import di atas

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

        // ISI KATEGORI AKSESORIS (List of Value Admin)
        // Category::create(['name' => 'Helm & Apparel', 'slug' => 'helm-apparel', 'type' => 'aksesoris']);
        // Category::create(['name' => 'Knalpot Racing', 'slug' => 'knalpot-racing', 'type' => 'aksesoris']);
        // Category::create(['name' => 'Velg & Ban', 'slug' => 'velg-ban', 'type' => 'aksesoris']);
        // Category::create(['name' => 'Suspensi / Shock', 'slug' => 'suspensi', 'type' => 'aksesoris']);

        // // ISI KATEGORI SPAREPART
        // Category::create(['name' => 'Mesin & Piston', 'slug' => 'mesin-piston', 'type' => 'sparepart']);
        // Category::create(['name' => 'Kelistrikan', 'slug' => 'kelistrikan', 'type' => 'sparepart']);
        // Category::create(['name' => 'Pengereman', 'slug' => 'pengereman', 'type' => 'sparepart']);
        // Category::create(['name' => 'Oli & Cairan', 'slug' => 'oli-cairan', 'type' => 'sparepart']);
    }
}