<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $connection = 'cursos';

    protected $guarded = ['id'];

    //relacion polimorfica
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function commets()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reactions()
    {
        return $this->morphMany(Raction::class, 'ractionable');
    }
}
