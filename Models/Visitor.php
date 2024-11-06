<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Visitor extends Authenticatable
{
    use HasFactory;

    protected $table = "visitors";

    protected $fillable =
        ['name',
        'phone',
        'email',
        'password',
        'code',
        'status',
        'role_id',
    ];
}
