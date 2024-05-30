<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\MobileInterface;

use App\Services\Free;

class MobileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MobileInterface::class, Free::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
