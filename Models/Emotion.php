<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;

    protected $table = "emotions";

    protected $fillable =
        ['visitor_id',
        'hospital_id',
        'post_id',
        'result',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Manager::class, 'hospital_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
