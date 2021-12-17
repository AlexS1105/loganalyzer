<?php

namespace Alexxx007\LogAnalyzer\Providers;

use Alexxx007\LogAnalyzer\Charts\RouteChart;
use Alexxx007\LogAnalyzer\Charts\SalesChart;
use Alexxx007\LogAnalyzer\Charts\UserRouteChart;
use Alexxx007\LogAnalyzer\Charts\UserSalesChart;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class LogAnalyzerServiceProvider extends ServiceProvider
{
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
