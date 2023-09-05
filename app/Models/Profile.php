<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['title','biography','website','facebook','linkedin','youtube','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
