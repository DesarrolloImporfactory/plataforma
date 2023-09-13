<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $connection = 'cursos';
    
    use HasFactory;

    protected $fillable = ['name','course_id'];

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
