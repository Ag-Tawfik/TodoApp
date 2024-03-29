<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoAppTest extends TestCase
{
    use RefreshDatabase;

    private $endPoint = '/api/todos/';

    public function testCreateTodo()
    {
        Todo::factory(5)->create();

        $this->json('GET', $this->endPoint)
            ->assertSee(Todo::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostTodo()
    {
        $Data = [
            'name' => 'Luna',
            'description' => 'description For Luna',
            'type' => 'Normal',
            'due_time' => '01:30',
            'day' => 'Monday'
        ];

        $this->json('POST', $this->endPoint, $Data)
            ->assertStatus(201);
    }
    //
    public function testUpdateTodo()
    {
        Todo::factory(5)->create();

        $data = [
            'name' => 'name1',
            'description' => 'description1',
            'type' => 'Normal',
            'due_time' => '12:00',
            'day' => 'Monday'
        ];

        $this->json('PUT', $this->endPoint . "2", $data)
            ->assertSee('name1')
            ->assertStatus(200);
    }
    //
    public function testDeleteTodo()
    {
        Todo::factory()->times(5)->create();

        $id_to_be_deleted = random_int(1, 5);

        $this->json('DELETE', $this->endPoint . "$id_to_be_deleted/")->assertStatus(204);

        $this->assertDatabaseMissing('todos', ['id' => $id_to_be_deleted]);
    }
}
