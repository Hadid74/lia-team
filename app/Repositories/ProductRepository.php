<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Eloquent\Model;

class ProductRepository implements ProductRepositoryContract
{

    public function index(): Collection
    {
        return Product::all();
    }

    public function create(array $payload):Model
    {
        return Product::create($payload);
    }

    public function show(string $id): Product
    {
        return Product::find($id);
    }

    public function update(string $id,array $payload): bool
    {
        $product=Product::find($id);
        return $product->update($payload);
    }

    public function delete(string $id): bool
    {
        return Product::destroy([$id]);
    }
}
