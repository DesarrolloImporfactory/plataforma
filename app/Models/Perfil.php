<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfils';

    public function names(){
        return $this->belongsTo(Name::class,'name_id','id');
    }

    public function tipos(){
        return $this->belongsTo(Tipo::class,'tipo_id','id');
    }
    public function sistemas(){
        return $this->belongsTo(Sistema::class,'sistema_id','id');
    }
}
