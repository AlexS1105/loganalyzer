<?php

declare(strict_types = 1);

namespace Alexxx007\LogAnalyzer\Charts;

use Alexxx007\LogAnalyzer\Models\Log;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteChart extends ReportChart
{
    protected function recommendations($data)
    {
        $recommendations = [];
        arsort($data);

        if (array_key_first($data) != "products.show") {
            array_push($recommendations, "Мало посещений страницы с информацией. Возможно, её необходимо дополнить.");
        }

        if (array_key_first($data) != "products.review") {
            array_push($recommendations, "Мало посещений страницы с обзорами. Возможно, необходимо добавить больше обзоров.");
        }

        return $recommendations;
    }

    public function handler(Request $request): Chartisan
    {
        $productId = $request->get('product_id');
        $purchases = Log::where('product_id', $productId)
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
            ->extra($this->recommendations($amounts))
            ->dataset('Посещения', $values);
    }
}
