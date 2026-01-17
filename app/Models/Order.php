<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'order_number', 
        'total_price', 
        'status', 
        'payment_method', 
        'payment_status', 
        'email'
    ];

    /**
     * Relasi ke User (Pembeli)
     * Ini yang menyebabkan error tadi karena belum ada fungsinya.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke OrderItems (Daftar Barang)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}