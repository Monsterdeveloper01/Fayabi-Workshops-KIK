<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'user_id', 'category_id', 'name', 'slug', 'brand', 
    'price', 'stock', 'weight', 'condition', 
    'description', 'image', 'compatibility'
];

// Relasi: Produk milik satu Kategori
public function category()
{
    return $this->belongsTo(Category::class);
}

// Relasi: Produk milik satu Vendor (User)
public function user()
{
    return $this->belongsTo(User::class);
}
}
