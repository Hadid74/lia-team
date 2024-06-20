<?php

namespace App\Contracts\Repositories;


use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Eloquent\Model;

interface ProductRepositoryContract
{
    public function index(): Collection;

    public function create(array $payload): Model;

    public function show(string $id): Product;

    public function update(string $id,array $payload): bool;

    public function delete(string $id): bool;
}
