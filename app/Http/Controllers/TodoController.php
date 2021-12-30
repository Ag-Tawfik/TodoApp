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

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        if ($todo->save())
            return new TodoResource($todo);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return new TodoResource($todo);
    }

    public function update(TodoRequest $request, $id)
    {

        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->description = $request->description;

        $todo->save();
        return new TodoResource($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        if ($todo->delete()) {
            return new TodoResource($todo);
        }
    }
}
