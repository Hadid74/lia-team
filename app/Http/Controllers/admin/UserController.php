<?php

namespace App\Http\Controllers\admin;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function index()
    {
        return $this->userRepository->index();

    }

    public function createAdmin(string $id)
    {
        return $this->userRepository->createAdmin($id);
    }
}
