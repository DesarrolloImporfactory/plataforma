<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SectionFactory extends Factory
{
   
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
}
