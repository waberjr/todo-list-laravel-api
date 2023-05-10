<?php

namespace App\Policies;

use App\Models\TodoTask;
use App\Models\User;

class TodoTaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, TodoTask $todoTask)
    {
        return $user->id === $todoTask->todo->user_id;
    }

    public function destroy(User $user, TodoTask $todoTask)
    {
        return $user->id === $todoTask->todo->user_id;
    }
}
