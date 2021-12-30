<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_a_todo_has_a_tasks()
    // {
    //     $todo = Todo::factory()->create();
    //     $task = Task::factory()->create(['todo_id' => $todo->id]);

    //     $this->assertEquals(1, $todo->phone->count()); 

    // }

    public function test_task_belongs_to_a_todo()
    {
        $todo = Todo::factory()->create();
        $task = Task::factory()->create(['todo_id' => $todo->id]);

        $this->assertEquals(1, $todo->count());
        // $this->assertInstanceOf(Todo::class, $todo->name);
    }
}
