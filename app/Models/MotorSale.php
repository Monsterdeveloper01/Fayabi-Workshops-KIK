<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorSale extends Model
{
  protected $fillable = [
    'user_id', // WAJIB ADA
    'brand', 
    'model', 
    'year', 
    'mileage', 
    'description', 
    'image', 
    'price_offer', 
    'whatsapp', 
    'status'
];
public function user() {
    return $this->belongsTo(User::class);
}
}
