<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Log;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Route extends ReportChart
{
    public function handler(Request $request): Chartisan
    {
        $productId = $request->get('product_id');
        $purchases = Log::where('product_id', $productId)
            ->where('route', 'products.buy')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as amount')
            ]);
        
        $amounts = $purchases->pluck('amount', 'date')->all();

        $this->fillEmpty($amounts);
        $forecast = $this->forecast($amounts);

        $keys = array_keys(array_merge($amounts, $forecast));
        $values = array_values($amounts);
        $forecastValues = array_merge(array_fill(0, count($values), 0), array_values($forecast));

        return Chartisan::build()
            ->labels($keys)
            ->dataset('Продажи', $values)
            ->dataset('Прогноз', $forecastValues);
    }
}
