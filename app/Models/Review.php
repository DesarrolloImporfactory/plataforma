<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $connection = 'cursos';
    
    use HasFactory;
    protected $fillable = ['comment','rating','user_id','course_id'];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function courses(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
