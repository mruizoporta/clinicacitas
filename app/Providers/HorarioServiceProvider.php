<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\HorarioServicesInterface;
use App\Services\HorarioService;

class HorarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(HorarioServicesInterface::class, HorarioService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
