<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthForgotPasswordRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

/**
 * [Description AuthController]
 */
class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param AuthLoginRequest $request
     * 
     * @return UserResource
     */
    public function login(AuthLoginRequest $request): UserResource
    {
        $input = $request->validated();

        $token = $this->authService->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional($token);
    }

    /**
     * @param AuthRegisterRequest $request
     * 
     * @return UserResource
     */
    public function register(AuthRegisterRequest $request): UserResource
    {
        $input = $request->validated();

        $user = $this->authService->register(
            $input['first_name'],
            $input['last_name'] ?? '',
            $input['email'],
            $input['password'],
        );

        return new UserResource($user);
    }

    /**
     * @param AuthVerifyEmailRequest $request
     * 
     * @return UserResource
     */
    public function verifyEmail(AuthVerifyEmailRequest $request): UserResource
    {
        $input = $request->validated();

        $user = $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }

    /**
     * @param AuthForgotPasswordRequest $request
     * 
     * @return bool
     */
    public function forgotPassword(AuthForgotPasswordRequest $request): bool
    {
        $input = $request->validated();

        return $this->authService->forgotPassword($input['email']);
    }
}
