<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RequirementFactory extends Factory
{
   
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
}
