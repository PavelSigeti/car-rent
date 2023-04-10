<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'name', 'slug',
        'title', 'seo_title', 'big_title',
        'small_title', 'seo_description', 'text',
    ];

    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }

}
