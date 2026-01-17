<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    protected $fillable = [
    'user_id', 'service_type', 'nama', 'whatsapp', 
    'motor_brand', 'motor_model', 'motor_size', 
    'package_name', 'booking_date', 'booking_time', 
    'budget', 'notes', 'status'
];
}
