<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoTaskStoreResource;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\TodoTask;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    public function show(Todo $todo)
    {
        $todo->load('tasks');
        return new TodoResource($todo);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();

        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }

    public function update(Todo $todo, TodoUpdateRequest $request)
    {
        $input = $request->validated();

        $todo->fill($input);
        $todo->save();

        return new TodoResource($todo->fresh());
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function addTask(Todo $todo, TodoTaskStoreResource $request)
    {
        $input = $request->validated();

        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);
    }
}
