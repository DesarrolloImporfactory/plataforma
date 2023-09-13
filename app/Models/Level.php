<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $connection = 'cursos';
    
    public $timestamps = false;
    protected $fillable = ['name'];

    public function course(){
        return $this->hasMany(Course::class,'level_id','id');
    }
}
