<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type'];

    /**
     * Relasi: Satu Kategori memiliki BANYAK Produk.
     * Ini yang dicari oleh Controller tadi.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}