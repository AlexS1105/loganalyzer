<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Log;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSalesChart extends ReportChart
{
    public function handler(Request $request): Chartisan
    {
        $userId = $request->get('user_id');
        $purchases = Log::with('product')
            ->where('user_id', $userId)
            ->where('route', 'products.buy')
            ->get()
            ->groupBy('product.name')
            ->map
            ->count();
        
        $amounts = $purchases->all();

        $keys = array_keys($amounts);
        $values = array_values($amounts);

        return Chartisan::build()
            ->labels($keys)
            ->dataset('Продажи', $values);
    }
}
