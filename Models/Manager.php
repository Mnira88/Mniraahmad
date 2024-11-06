<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use HasFactory;

    protected $table = "managers";

    protected $fillable =
        ['name',
        'hospital',
        'phone',
        'email',
        'password',
        'code',
        'status',
        'role_id',
    ];
}
