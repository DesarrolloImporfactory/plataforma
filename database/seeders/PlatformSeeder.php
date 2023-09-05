<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    
    public function run()
    {
        Platform::create([
            'name' => 'youtube',
        ]);

        Platform::create([
            'name' => 'vimeo',
        ]);
    }
}
