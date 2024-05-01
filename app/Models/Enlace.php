<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    use HasFactory;

    protected $connection = 'cursos';

    protected $fillable = [
        'url', 'name','lesson_id',
    ];

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'Lesson_id', 'id');
    }
}
