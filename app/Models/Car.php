<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'engine',
        'seats', 'year', 'slug',
        'is_published', 'seo_title', 'seo_description',
        'seo_text', 'price2', 'price3',
        'msg', 'zalog', 'home_place',
        'discount',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function prices()
    {
        return $this->hasMany(CarPrice::class);
    }

    public function metas()
    {
        return $this->belongsToMany('App\Models\Meta');
    }



}
