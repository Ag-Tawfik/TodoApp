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
    public function testCreate()
    {

        Todo::factory(5)->create();

        $this->json('GET', '/api/todos/')
            ->assertSee(Todo::find(rand(1, 5))->name)
            ->assertStatus(200);
    }
    //
    public function testPostMethod()
    {
        $updatedData = array();
        $updatedData['name'] = 'partner';
        $updatedData['description'] = 'seller';

        $response = $this->json('POST', '/api/todo', $updatedData);

        $response
            ->assertStatus(201);
    }
    //
    public function testUpdateMethod()
    {
        Todo::factory()->create();

        $data = [
            'name' => 'Alex',
            'description' => 'TTT',
        ];

        $this->put("/api/todo/1/", $data)
            ->assertSee('Alex')
            ->assertStatus(200);
    }
    //
    public function testDeleteMethod()
    {
        $this->withoutExceptionHandling();
        Todo::factory()->times(5)->create();
        $id_to_be_deleted = random_int(1, 5);
        $this->delete("/api/todo/$id_to_be_deleted/");
        $this->assertDatabaseMissing('todo', ['id' => $id_to_be_deleted]);
    }
}
