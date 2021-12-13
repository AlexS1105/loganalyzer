<?php

use App\Http\Controllers\ProductController;
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

Route::middleware([Logging::class])->group(function() {
    Route::get('/', function() {
        return redirect('/products');
    });
    
    Route::post('products/{product}/buy', [ProductController::class, 'buy'])
        ->name('products.buy');
    
    Route::resource('products', ProductController::class)
        ->only(['index', 'show']);
});
