<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'product_id', 
        'product_name', 
        'price', 
        'qty'
    ];

    /**
     * Relasi ke Produk
     * Ini yang bikin error tadi karena belum ada.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke Order (Opsional, tapi bagus ada)
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}