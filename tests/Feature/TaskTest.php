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
    public function test_a_todo_has_a_tasks()
    {
        $todo = Todo::factory()->create();
        $task = Task::factory()->create(['todo_id' => $todo->id]);

        $this->assertEquals(1, $task->count()); 

    }

    public function test_task_belongs_to_a_todo()
    {
        $todo = Todo::factory()->create();
        $this->assertEquals(1, $todo->count());
        // $this->assertInstanceOf(Todo::class, $todo->name);
    }

    public function testCreateTask()
    {

        Task::factory(5)->create();

        $this->json('GET', '/api/tasks/')
            ->assertSee(Task::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostTask()
    {
        $updatedData = array();
        $updatedData['name'] = 'Create Money';
        $updatedData['todo_id'] = '5';
        $updatedData['description'] = 'Brad';
        $updatedData['type'] = 'Urgent';
        $updatedData['day'] = 'Wednesday';

        $response = $this->json('POST', '/api/task', $updatedData);
        $response
            ->assertStatus(201);
    }
    //
    public function testUpdateTask()
    {
        Task::factory()->create();

        $data = [
            'name' => 'Marry',
            'description' => 'TTT',
            'type' => 'Normal',
            'day' => 'Tuesday',
        ];

        $this->put("/api/task/1", $data)
            ->assertSee('Marry')
            ->assertStatus(200);
    }
    //
    public function testDeleteTask()
    {
        $this->withoutExceptionHandling();
        Task::factory()->times(5)->create();
        $id_to_be_deleted = random_int(1, 5);
        $this->delete("/api/task/$id_to_be_deleted/");
        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]);
    }
}
