<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Support\Facades\Session;
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
    public function testCreate()
    {

        Todo::factory(5)->create();

        $this->json('GET', '/api/todo/')
            ->assertSee(Todo::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostMethod()
    {
        $updatedData = array();
        $updatedData['todolist_id'] = "1";
        $updatedData['name'] = 'partner';
        $updatedData['description'] = 'seller';
        $updatedData['type'] = 'en';
        $updatedData['day'] = 'Wednesday';

        $response = $this->json('POST', '/api/todos', $updatedData);

        $response
            ->assertStatus(201);
    }
    //
    public function testUpdateMethod()
    {
        Todo::factory()->create();

        $data = [
            'name' => 'rqndom',
            'description' => 'TTT',
            'type' => 'hhh',
            'day' => 'Tuesday',
        ];

        $this->put("/api/todos/1/", $data)
        ->assertSee('rqndom')
            ->assertStatus(200);
    }
    //
    public function testDeleteMethod()
    {
        $this->withoutExceptionHandling();
        Todo::factory()->times(5)->create();
        $id_to_be_deleted = random_int(1, 5);
        $this->delete("/api/todos/$id_to_be_deleted/");
        $this->assertDatabaseMissing('todo', ['id' => $id_to_be_deleted]);
    }
}
