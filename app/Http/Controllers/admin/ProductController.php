<?php

namespace App\Http\Controllers\admin;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepositoryContract $productRepository
    )
    {
    }

    public function index()
    {
        return $this->productRepository->index();
    }

    public function create(ProductRequest $request)
    {
        return $this->productRepository->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->productRepository->show($id);
    }

    public function update(string $id,ProductRequest $request)
    {
        return $this->productRepository->update($id, $request->validated());
    }

    public function delete(string $id)
    {
        return $this->productRepository->delete($id);
    }
}
