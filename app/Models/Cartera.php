<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    use HasFactory;

    protected $fillable = ['estado', 'fecha', 'saldo', 'alumno_id', 'detalle'];

    public function alumnos()
    {
        return $this->belongsTo(User::class, 'alumno_id', 'id');
    }

    // public function comision()
    // {
    //     return $this->belongsTo(Comision::class, 'comision_id', 'id');
    // }

    public function abonos()
    {
        return $this->hasMany(Abono::class, 'cartera_id', 'id');
    }

    public function comision()
    {
        return $this->hasOne(Comision::class, 'cartera_id', 'id');
    }
}
