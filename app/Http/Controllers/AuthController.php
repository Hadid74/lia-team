<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function __construct(
        private readonly UserRepositoryContract $userRepository,
    )
    {}

    public function register(RegisterRequest $request)
    {
        return $this->userRepository->create($request->validated());
    }

    public function login(LoginRequest $request)
    {

        return $this->userRepository->login($request->validated());
    }

    public function logout()
    {

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
