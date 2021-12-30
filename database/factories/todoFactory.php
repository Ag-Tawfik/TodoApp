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
            'type' => $this->faker->word(1),
            //'time' => $this->faker->time('H'),
            'day' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            
        ];
    }
}
