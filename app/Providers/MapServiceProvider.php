<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\MapInterface;

use App\Services\Google;

class MapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MapInterface::class, Google::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
