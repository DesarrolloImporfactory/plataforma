<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscription extends Model
{
    use HasFactory;

    protected $table = 'suscripcions';

    protected $fillable = [
        'usuario_id',
        'sistema_id',
        'tipo_id',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'dias'
    ];

    public function usuarios(){
        return $this->belongsTo(User::class,'usuario_id','id');
    }
    public function tipos(){
        return $this->belongsTo(Tipo::class,'tipo_id','id');
    }
    public function sistemas(){
        return $this->belongsTo(Sistema::class,'sistema_id','id');
    }
}
