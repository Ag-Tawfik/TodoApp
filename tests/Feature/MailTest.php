<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\NewCreatedTodoEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    private $endPoint = '/api/todos/';

    public function testEmailNotification()
    {
        Event::fake([
            NewCreatedTodoEvent::class
        ]);

        $data = [
            'name' => 'Luna',
            'description' => 'description For Luna',
            'type' => 'Normal',
            'due_time' => '01:30',
            'day' => 'Monday'
        ];

        $this->json('POST', $this->endPoint, $data);
        Event::assertDispatched(NewCreatedTodoEvent::class);
    }
}
