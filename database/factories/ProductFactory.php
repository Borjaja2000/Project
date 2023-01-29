<?php

namespace Database\Factories;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->randomNumber(2),
            'photo' => null,
        ];
    }
}

