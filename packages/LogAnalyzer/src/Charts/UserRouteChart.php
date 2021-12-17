<?php

declare(strict_types = 1);

namespace Alexxx007\LogAnalyzer\Charts;

use Alexxx007\LogAnalyzer\Models\Log;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRouteChart extends ReportChart
{
    public function handler(Request $request): Chartisan
    {
        $userId = $request->get('user_id');
        $purchases = Log::where('user_id', $userId)
            ->where('route', '!=', 'products.buy')
            ->groupBy('route')
            ->get([
                DB::raw('route'),
                DB::raw('COUNT(*) as amount')
            ]);
        
        $amounts = $purchases->pluck('amount', 'route')->all();

        $keys = array_keys($amounts);
        $values = array_values($amounts);

        return Chartisan::build()
            ->labels($keys)
            ->dataset('Посещения', $values);
    }
}
