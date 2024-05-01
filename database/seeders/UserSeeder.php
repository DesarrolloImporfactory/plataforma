<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Ariel Taipe',
            'email' => 'ariel.12isaias@gmail.com',
            'password' =>  Hash::make('12345678'),
        ])->assignRole('Admin');

        // User::factory(50)->create();
    }
}