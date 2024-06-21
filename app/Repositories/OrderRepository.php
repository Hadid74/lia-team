<?php

namespace App\Repositories;

use App\CacheTagEnum;
use App\Contracts\Repositories\OrderRepositoryContract;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class OrderRepository implements OrderRepositoryContract
{

    public function index()
    {
        return Order::all();
    }

    public function create(array $payload)
    {
        return Order::create($payload);
    }

    public function delete(string $id)
    {
        return Order::destroy([$id]);
    }


    public function reductionProductInventory(array $products)
    {
            foreach ($products as $product) {
                $productBeforeUpdate=Product::find($product['_id']);
                $productBeforeUpdate->update(['inventory'=>$productBeforeUpdate->inventory - $product['inventory']]);
            }
        Cache::forget(CacheTagEnum::Product->value);
    }
}
