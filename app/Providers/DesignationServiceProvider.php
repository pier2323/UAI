<?php

namespace App\Providers;

use App\Services\DesignationService;
use Illuminate\Support\ServiceProvider;

class DesignationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DesignationService::class, function () {
            return new DesignationService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
