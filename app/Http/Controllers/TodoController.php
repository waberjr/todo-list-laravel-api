<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();

        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }
}
