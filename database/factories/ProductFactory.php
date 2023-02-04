<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->text(25),
            'description' => fake()->text(100),
            'price' => fake()->randomNumber(3),
            'photo' => null,
        ];
    }
}

