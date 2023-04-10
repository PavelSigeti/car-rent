<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'delivery_price', 'extra_price',
        'small_text', 'big_text', 'seo_title', 'seo_description',
        'slug', 'min_days', 'min_days_price',
    ];


}
