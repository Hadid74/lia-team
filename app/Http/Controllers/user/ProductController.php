<?php

namespace App\Http\Controllers\user;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
