<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{

    public function definition()
    {
        return [
            'url' => 'cursos/' . $this->faker->image('public/storage/cursos', 640, 480, null, false),
        ];
    }
}
