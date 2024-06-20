<?php

namespace App\Contracts\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use MongoDB\Laravel\Eloquent\Model;

interface UserRepositoryContract
{
    public function index():Collection;
    public function create(array $payload):Model;
    public function login(array $payload):Model|JsonResponse;

    public function createAdmin(string $id):bool;
}
