<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('tasks')->get();
        return TodoResource::collection($todos);
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create($request->all());
        // return response()->json($todo, 201);

        return new TodoResource($todo, 201);
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    public function update(TodoRequest $request, Todo $todo)
    {

        $todo->update($request->all());
        return new TodoResource($todo);

        // return response()->json('Update', 200);
    }

    public function destroy(Todo $todo)
    {

        $todo->delete();

        return response()->json('deleted', 204);
    }
}
