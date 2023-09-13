<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $connection = 'cursos';
    
    protected $fillable = ['body','course_id'];
    use HasFactory;

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
