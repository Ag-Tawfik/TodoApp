<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = task::All();
        return TaskResource::collection($tasks);
    }

    public function store(TaskCreateRequest $request)
    {
        $task = Task::create($request->all());

        return new TaskResource($task, 201);
    }

    public function show(task $task)
    {

        return new TaskResource($task);
    }

    public function update(TaskUpdateRequest $request, task $task)
    {      
        $task->update($request->all());
        return new TaskResource($task);
    }

    public function destroy(task $task)
    {
        $task->delete();
        
        return response()->json(null, 204);
    }
}
