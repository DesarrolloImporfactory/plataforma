<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    use HasFactory;

    protected $fillable = ['valor','vendedor_id','cartera_id','tipo_id'];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id', 'id');
    }

    public function cartera()
    {
        return $this->belongsTo(Cartera::class, 'cartera_id', 'id');
    }

    public function tipos()
    {
        return $this->belongsTo(TipoComision::class, 'tipo_id', 'id');
    }
}
