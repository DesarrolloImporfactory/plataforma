<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];

    public function course(){
        return $this->hasMany(Course::class,'categorie_id','id');
    }
}
