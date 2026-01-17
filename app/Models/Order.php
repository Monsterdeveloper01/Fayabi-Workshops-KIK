<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'total_price', 
        'status', 'payment_method', 'payment_status', 'email'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}