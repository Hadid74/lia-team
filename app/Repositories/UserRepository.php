<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use MongoDB\Laravel\Eloquent\Model;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserRepository implements UserRepositoryContract
{

    public function index(): Collection
    {
        return User::all();
    }
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

    public function createAdmin(string $id):bool
    {
        $user = User::find($id);
        throw_if(!$user, BadRequestException::class);
         $user->is_admin=1;
        return $user->save();
    }

}
