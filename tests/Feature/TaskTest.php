<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Todo;
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

    //     $this->assertEquals(1, $todo->count()); 

    // }

    // public function test_task_belongs_to_a_todo()
    // {
    //     $todo = Todo::factory()->create();
    //     $this->assertEquals(1, $todo->count());
    //     // $this->assertInstanceOf(Todo::class, $todo->name);
    // }

    public function testCreateTask()
    {
        Todo::factory(5)->create();

        Task::factory(5)->create();

        $this->json('GET', '/api/tasks')
            ->assertSee(Task::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostTask()
    {
        Todo::factory(5)->create();
        $updatedData = [
            'name' => 'Create Money',
            'todo_id' => '5',
            'description' => 'Brad_description',
            'type' => 'Urgent',
            'day' => 'Wednesday',
        ];

        $this->json('POST', '/api/tasks', $updatedData)
            ->assertStatus(201);
    }
    //
    public function testUpdateTask()
    {
        Todo::factory(5)->create();

        Task::factory(5)->create();

        $data = [
            'todo_id' => '1',
            'name' => 'Marry',
            'description' => 'TTT',
            'type' => 'Normal',
            'day' => 'Tuesday',
        ];

        $this->json('PUT', "/api/tasks/1", $data)
            ->assertSee('Marry')
            ->assertStatus(200);
    }
    //
    public function testDeleteTask()
    {
        Todo::factory(5)->create();

        Task::factory(5)->create();

        $id_to_be_deleted = random_int(1, 5);

        $this->json('DELETE', "/api/tasks/$id_to_be_deleted/")->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]);
    }
}