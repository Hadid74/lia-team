<?php

namespace App\Providers;

use App\Contracts\Repositories\OrderRepositoryContract;
use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public array $singletons = [
        UserRepositoryContract::class => UserRepository::class,
        ProductRepositoryContract::class => ProductRepository::class,
        OrderRepositoryContract::class => OrderRepository::class,

    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
