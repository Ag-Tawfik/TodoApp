<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $endPoint = '/api/tasks/';

    public function testCreateTask()
    {
        Todo::factory(5)->create();

        Task::factory(5)->create();

        $this->json('GET', $this->endPoint)
            ->assertSee(Task::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostTask()
    {
        Todo::factory(5)->create();
        Task::factory(5)->create();
        $Data = [
            'name' => 'Create Money',
            'description' => 'Braddescription',
            'todo_id' => '1'
        ];

        $this->json('POST', $this->endPoint, $Data)
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
        ];

        $this->json('PUT', $this->endPoint . "1", $data)
            ->assertSee('Marry')
            ->assertStatus(200);
    }
    //
    public function testDeleteTask()
    {
        Todo::factory(5)->create();

        Task::factory(5)->create();

        $id_to_be_deleted = random_int(1, 5);

        $this->json('DELETE', $this->endPoint . "$id_to_be_deleted/")->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]);
    }
}
