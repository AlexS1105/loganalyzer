<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;

class Logging
{
    public function handle(Request $request, Closure $next)
    {
        $prevLog = session('prevLog');
        $route = $request->route()->getName();
        $userId = auth()->user() != null ? auth()->user()->id : null;
        $product = $request->route()->parameter('product');
        $productId = $product != null ? $product->id : null;
        $prevLogId = $prevLog;
        
        $log = Log::create([
            'route' => $route,
            'user_id' => $userId,
            'product_id' => $productId,
            'prev_log_id' => $prevLogId
        ]);

        session(['prevLog' => $log->id]);

        return $next($request);
    }
}
