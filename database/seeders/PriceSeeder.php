<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    
    public function run()
    {
        Price::Create([
            'name' => 'Gratis',
            'value' => 0
        ]);

        Price::Create([
            'name' => '19.99 US$ (nivel 1)',
            'value' => 19.99
        ]);
        Price::Create([
            'name' => '9.99 US$ (nivel 2)',
            'value' => 49.99
        ]);
        Price::Create([
            'name' => '99.99 US$ (nivel 3)',
            'value' => 99.99
        ]);
    }
}
