<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public array $singletons = [
        UserRepositoryContract::class => UserRepository::class,
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
