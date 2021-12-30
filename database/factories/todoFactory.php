<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class todoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
