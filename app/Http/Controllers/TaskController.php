<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = task::All();
        return TaskResource::collection($tasks);
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return new TaskResource($task, 201);
    }

    public function show(task $task)
    {
        // $task = Task::findOrFail($task);

        return new TaskResource($task);
    }

    public function update(Request $request, task $task)
    {      
        $task->update($request->all());
        return new TaskResource($task);
    }

    public function destroy(task $task)
    {
        $task->delete();
        
        return response()->json('deleted', 204);
    }
}
