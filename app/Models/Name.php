<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $table = 'names';

    public function perfils()
    {
        return $this->hasMany(Perfil::class, 'perfil_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(Perfil::class, 'usuario_id', 'id');
    }
}
