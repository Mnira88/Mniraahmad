<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable =
        ['visitor_id',
        'hospital_id',
        'content',
        'department',
        'traetment_date',
        'replay',
        'result',
        'is_new',
        'status',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Manager::class, 'hospital_id');
    }

    public function emotions()
    {
        return $this->hasOne(Emotion::class, 'post_id', 'id');
    }
}
