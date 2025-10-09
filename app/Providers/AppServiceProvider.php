<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @author Jonathan Carrière
     */
    public function boot(): void
    {
        // Utiliser BootStrap lors de la pagination des résultats
        Paginator::useBootstrapFive();
    }
}
