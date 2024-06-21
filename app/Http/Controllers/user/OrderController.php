<?php

namespace App\Http\Controllers\user;

use App\Contracts\Repositories\OrderRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderCreateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderRepositoryContract $orderRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->orderRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(OrderCreateRequest $request)
    {
        $this->orderRepository->create($request->all());
    }
    public function destroy(string $id)
    {
        return $this->orderRepository->delete($id);
    }
}
