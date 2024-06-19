<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use MongoDB\Laravel\Eloquent\Model;

class UserRepository implements UserRepositoryContract
{

    public function create(array $payload): Model
    {
        return User::create($payload);
    }

    public function login(array $payload): Model|JsonResponse
    {
        if (! $token = auth()->attempt($payload)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600 * 60
        ]);
    }
}
