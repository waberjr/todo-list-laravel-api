<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Todo;

class TodoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function destroy(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function addTask(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
