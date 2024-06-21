<?php

namespace App\Contracts\Repositories;

interface OrderRepositoryContract
{
    public function index();
    public function create(array $payload);

    public function delete(string $id);

    public function reductionProductInventory(array $products);
}
