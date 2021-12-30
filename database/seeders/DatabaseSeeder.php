<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TasksSeeder;
use Database\Seeders\TodosSeeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Tasks::factory(10)->create();
        $this->call(TodosSeeder::class);
        $this->call(TasksSeeder::class);
    }
}
