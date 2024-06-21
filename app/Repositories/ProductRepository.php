<?php

namespace App\Repositories;

use App\CacheTagEnum;
use App\Contracts\Repositories\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use MongoDB\Laravel\Eloquent\Model;

class ProductRepository implements ProductRepositoryContract
{

    public function index(): Collection
    {
         return Cache::remember(CacheTagEnum::Product->value,3600, function () {
            return Product::all();
        });
    }

    public function create(array $payload):Model
    {
        Cache::forget(CacheTagEnum::Product->value);
        return Product::create($payload);
    }

    public function show(string $id): Product
    {
        return Product::find($id);
    }

    public function update(string $id,array $payload): bool
    {
        Cache::forget(CacheTagEnum::Product->value);
        $product=Product::find($id);
        return $product->update($payload);
    }

    public function delete(string $id): bool
    {
        Cache::forget(CacheTagEnum::Product->value);
        return Product::destroy([$id]);
    }
}
