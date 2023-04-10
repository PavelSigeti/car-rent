<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'HTTP_X_REAL_IP', 'HTTP_USER_AGENT', 'HTTP_ACCEPT_LANGUAGE',
        'HTTP_COOKIE', 'REQUEST_TIME', 'REQUEST_METHOD',
        'REQUEST_URI',
    ];
}
