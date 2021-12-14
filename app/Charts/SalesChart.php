<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Log;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesChart extends ReportChart
{
    protected function recommendations($data, $forecast)
    {
        $recommendations = [];
        $sum = Log::where('route', 'products.buy')->groupBy('product_id')->get([DB::raw('COUNT(*) as amount')]);
        $average = $sum->avg('amount');
        $collection = collect($data);
        $averageProduct = $collection->sum();

        if ($averageProduct < $average) {
            array_push($recommendations, 'Продажи товара ниже среднего. Возможно, необходимо дополнительное продвижение.');
        }

        return $recommendations;
    }

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
            ->extra($this->recommendations($amounts, $forecast))
            ->dataset('Продажи', $values)
            ->dataset('Прогноз', $forecastValues);
    }
}
