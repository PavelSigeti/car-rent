<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name', 'price', 'comment', 'total_price',
        'delivery_price', 'delivery_price_back', 'days',
        'start_place_id', 'end_place_id', 'start_at',
        'end_at', 'name', 'phone', 'status',
    ];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service');
    }
}
