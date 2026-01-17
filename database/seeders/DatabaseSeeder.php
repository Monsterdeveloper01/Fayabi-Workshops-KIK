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
    
        // ISI KATEGORI AKSESORIS (List of Value Admin)
        Category::create(['name' => 'Helm & Apparel', 'slug' => 'helm-apparel', 'type' => 'aksesoris']);
        Category::create(['name' => 'Knalpot Racing', 'slug' => 'knalpot-racing', 'type' => 'aksesoris']);
        Category::create(['name' => 'Velg & Ban', 'slug' => 'velg-ban', 'type' => 'aksesoris']);
        Category::create(['name' => 'Suspensi / Shock', 'slug' => 'suspensi', 'type' => 'aksesoris']);

        // ISI KATEGORI SPAREPART
        Category::create(['name' => 'Mesin & Piston', 'slug' => 'mesin-piston', 'type' => 'sparepart']);
        Category::create(['name' => 'Kelistrikan', 'slug' => 'kelistrikan', 'type' => 'sparepart']);
        Category::create(['name' => 'Pengereman', 'slug' => 'pengereman', 'type' => 'sparepart']);
        Category::create(['name' => 'Oli & Cairan', 'slug' => 'oli-cairan', 'type' => 'sparepart']);
    }
}