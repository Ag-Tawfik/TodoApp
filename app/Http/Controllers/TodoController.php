<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Events\NewCreatedTodoEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoUpdateRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('tasks')->get();

        return TodoResource::collection($todos);
    }

    public function store(TodoCreateRequest $request)
    {
        $todo = Todo::create($request->all());

        event(new NewCreatedTodoEvent('taoufik@mgssoftware.net'));

        return new TodoResource($todo, 201);
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    public function update(TodoUpdateRequest $request, Todo $todo)
    {
        $todo->update($request->all());

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json(null, 204);
    }
}
