<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'todo_id' => $this->faker->randomElement(['1', '5']),
            'name' => $this->faker->firstName(),
            'description' => $this->faker->paragraph(5),
            'type' => $this->faker->randomElement(['Normal', 'Urgent']),
            //'time' => $this->faker->time('H'),
            'day' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
        ];
    }
}
