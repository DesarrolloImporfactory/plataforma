<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $connection = 'cursos';

    protected $fillable = ['name','lesson_id'];

    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }
}
