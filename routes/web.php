<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\Logging;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('index');
})->name('index');

Route::get('report', function() {
    return view('reports.index');
})->name('reports.index');

Route::get('report/user', [ReportController::class, 'users'])->name('reports.users.index');

Route::get('report/product', [ReportController::class, 'products'])->name('reports.products.index');

Route::get('report/user/{user}', [ReportController::class, 'showUser'])->name('reports.users.show');

Route::get('report/product/{product}', [ReportController::class, 'showProduct'])->name('reports.products.show');

Route::middleware([Logging::class])->group(function() {
    Route::post('products/{product}/buy', [ProductController::class, 'buy'])
        ->name('products.buy');
    
    Route::resource('products', ProductController::class)
        ->only(['index', 'show']);
});
