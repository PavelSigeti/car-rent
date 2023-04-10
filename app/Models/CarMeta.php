<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMeta extends Model
{
    use HasFactory;

    protected $table = 'car_meta';

    public $timestamps = false;
}
