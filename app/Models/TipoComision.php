<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComision extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','valor','vendedor_id'
    ];

    
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id', 'id');
    }

    public function comision()
    {
        return $this->hasMany(Comision::class, 'tipo_id', 'id');
    }
}
