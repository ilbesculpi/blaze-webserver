<?php

namespace App\Domain\Users\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Services\UserService;

class UserDomainProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRespository::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
