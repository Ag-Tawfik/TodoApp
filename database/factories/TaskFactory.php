<?php

namespace Database\Factories;

use App\Models\Todo;
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
            'todo_id' => Todo::pluck('id')->random(),
            // 'todo_id' => Todo::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
        ];
    }
}
