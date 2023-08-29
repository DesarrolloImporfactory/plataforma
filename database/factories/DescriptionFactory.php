<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DescriptionFactory extends Factory
{
    
    public function definition()
    {
        return [
            'name' => $this->faker->paragraph()
        ];
    }
}
