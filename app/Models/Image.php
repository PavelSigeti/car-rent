<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = [
        'type', 'object_id', 'group_id', 'uri',
    ];

    public function getUpdatedAtAttribute($value)
    {

        return mb_substr($value, 0,10);
    }

}
