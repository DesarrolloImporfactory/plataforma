<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $connection = 'cursos';
    
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];

    public function lesson(){
        return $this->hasMany(Lesson::class,'lesson_id','id');
    }
}
