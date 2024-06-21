<?php

namespace App\Observers;

use App\Contracts\Repositories\OrderRepositoryContract;
use App\Models\Order;

class OrderObserver
{

    public function __construct(
        private readonly OrderRepositoryContract $orderRepository)
    {
    }

    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $this->orderRepository->reductionProductInventory($order->products()->get()->toArray());
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
