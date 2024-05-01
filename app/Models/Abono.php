<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $fillable = ['fecha','valor','cartera_id','archivo','forma_id'];


    public function cartera()
    {
        return $this->belongsTo(Cartera::class, 'cartera_id', 'id');
    }

    public function forma()
    {
        return $this->belongsTo(Forma::class, 'forma_id', 'id');
    }
}
