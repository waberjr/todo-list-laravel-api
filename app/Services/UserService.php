<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * @param User $user
     * @param array $input
     * 
     * @return User
     */
    public function update(User $user, array $input): User
    {
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $user->fill($input);
        $user->save();

        return $user->fresh();
    }
}
