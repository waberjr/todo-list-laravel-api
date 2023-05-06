<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }
}
