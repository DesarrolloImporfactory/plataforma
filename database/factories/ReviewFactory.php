<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ReviewFactory extends Factory
{
    
    public function definition()
    {
        return [
            'comment' => $this->faker->text(),
            'rating'=> $this->faker->randomElement([3,4,5]),
            'user_id' => User::all()->random()->id
        ];
    }
}
