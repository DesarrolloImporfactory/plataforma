<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma extends Model
{
    use HasFactory;

    public function abonos()
    {
        return $this->hasMany(Abono::class, 'forma_id', 'id');
    }
}
