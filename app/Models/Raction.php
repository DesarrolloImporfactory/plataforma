<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raction extends Model
{
    protected $connection = 'cursos';
    
    use HasFactory;
    const LIKE = 1;
    const DISLIKE = 2;

    public function ractionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
