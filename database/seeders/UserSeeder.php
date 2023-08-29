<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Ariel Taipe',
            'email' => 'ariel.12isaias@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::factory(50)->create();
    }
}
