<?php

namespace App\Listeners;

use App\Mail\TodoCreatedMail;
use Illuminate\Support\Facades\Mail;

class NewCreatedTodoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->email)->send(new TodoCreatedMail());
    }
}
