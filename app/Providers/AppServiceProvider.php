<?php

namespace App\Providers;

use App\Charts\RouteChart;
use App\Charts\SalesChart;
use App\Charts\UserRouteChart;
use App\Charts\UserSalesChart;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            SalesChart::class,
            RouteChart::class,
            UserSalesChart::class,
            UserRouteChart::class
        ]);
    }
}
