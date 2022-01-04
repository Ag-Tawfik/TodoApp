<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoAppTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //
    public function testCreateTodo()
    {
        Todo::factory(5)->create();

        $this->json('GET', '/api/todos')
            ->assertSee(Todo::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostTodo()
    {
        $PostdData = [
            'name' => 'Luna',
            'description' => 'description For Luna',
            'type' => 'Normal',
            'due_time' => '01:30',
            'day' => 'Monday'
        ];

        $this->json('POST', '/api/todos', $PostdData)
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

        $this->json('PUT', "/api/todos/1", $data)
            ->assertSee('name1')
            ->assertStatus(200);
    }
    //
    public function testDeleteTodo()
    {
        Todo::factory()->times(5)->create();

        $id_to_be_deleted = random_int(1, 5);

        $this->json('DELETE', "/api/todos/$id_to_be_deleted/")->assertStatus(204);

        $this->assertDatabaseMissing('todos', ['id' => $id_to_be_deleted]);
    }
}
