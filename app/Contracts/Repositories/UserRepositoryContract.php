<?php

namespace App\Contracts\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use MongoDB\Laravel\Eloquent\Model;

interface UserRepositoryContract
{
    public function create(array $payload):Model;
    public function login(array $payload):Model|JsonResponse;
}
