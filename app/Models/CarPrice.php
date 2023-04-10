<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPrice extends Model
{
    use HasFactory;

    protected $fillable = [
      'car_id', 'start', 'end',
      'price', 'price2', 'price3',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

}
