<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderService extends Pivot
{
    use HasFactory;

    protected $table = 'order_service';

}
