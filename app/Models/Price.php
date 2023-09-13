<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $connection = 'cursos';
    
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','value'];

    public function course(){
        return $this->hasMany(Course::class,'price_id','id');
    }
}
