<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateRequest;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::All();
        return TodoResource::collection($todos);
    }

    public function store(TodoRequest $request)
    {

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->type = $request->type;
        $todo->day = $request->day;
        if ($todo->save())
            return new TodoResource($todo);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return new TodoResource($todo);
    }

    public function update(updateRequest $request, $id)
    {

        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->type = $request->type;
        $todo->day = $request->day;

        $todo->save();
        //dd('tyty');
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
