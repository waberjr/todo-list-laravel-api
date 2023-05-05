<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\ResetPasswordTokenInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Str;


class AuthService
{
    /**
     * @param string $email
     * @param string $password
     * 
     * @return array
     */
    public function login(string $email, string $password): array
    {
        $login = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth()->attempt($login)) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * 
     * @return User
     */
    public function register(string $firstName, string $lastName, string $email, string $password): User
    {
        $user = User::where('email', $email)->exists();
        if ($user) {
            throw new UserHasBeenTakenException();
        }

        $userPassword = bcrypt($password ?? Str::random(10));

        $user = User::create([
            'first_name' => $firstName,
            'lastr_name' => $lastName,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);

        event(new UserRegistered($user));

        return $user;
    }

    /**
     * @param string $token
     * 
     * @return User
     */
    public function verifyEmail(string $token): User
    {
        $user = User::where('confirmation_token', $token)->first();
        if (!$user) {
            throw new VerifyEmailTokenInvalidException();
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    /**
     * @param string $email
     * 
     * @return bool
     */
    public function forgotPassword(string $email): bool
    {
        $user = User::where('email', $email)->firstOrFail();
        $token = Str::random(60);

        PasswordResetToken::create([
            'email' => $user->email,
            'token' => $token
        ]);

        event(new ForgotPassword($user, $token));

        return true;
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $token
     * 
     * @return bool
     */
    public function resetPassword(string $email, string $password, string $token): bool
    {
        $passReset = PasswordResetToken::where('email', $email)->where('token', $token)->first();

        if (empty($passReset)) {
            throw new ResetPasswordTokenInvalidException();
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->password = bcrypt($password);
        $user->save();

        PasswordResetToken::where('email', $email)->delete();

        return true;
    }
}
