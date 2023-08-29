<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{

    public function run()
    {
        Level::create([
            'name' => 'Nivel basico'
        ]);
        Level::create([
            'name' => 'Nivel intermedio'
        ]);
        Level::create([
            'name' => 'Nivel avanzado'
        ]);
    }
}
