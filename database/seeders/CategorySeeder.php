<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            'name' => 'Desarrollo web',
        ]);
        Categorie::create([
            'name' => 'Diseño web',
        ]);
        Categorie::create([
            'name' => 'Programacion web',
        ]);
    }
}
