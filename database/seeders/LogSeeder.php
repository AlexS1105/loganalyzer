<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    private function randomDateInRange(DateTime $start, DateTime $end) {
        $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new DateTime();
        $randomDate->setTimestamp($randomTimestamp);
        return $randomDate;
    }

    public function run()
    {
        for($i = 0; $i <= 1000; $i++) {
            $datetime = $this->randomDateInRange(now()->subDays(28), now());
            $user = User::inRandomOrder()->first();
            $product = Product::inRandomOrder()->first();
            $delay = new DateInterval('PT5S');

            $log = Log::create([
                'route' => 'products.index',
                'user_id' => $user->id,
                'product_id' => null,
                'prev_log_id' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);

            $pages = [
                'products.show',
                'products.opinion',
                'products.review'
            ];

            $log = Log::create([
                'route' => $pages[array_rand($pages)],
                'user_id' => $user->id,
                'product_id' => $product->id,
                'prev_log_id' => $log->id,
                'created_at' => $log->created_at->add($delay),
                'updated_at' => $log->updated_at->add($delay)
            ]);

            $log = Log::create([
                'route' => 'products.buy',
                'user_id' => $user->id,
                'product_id' => $product->id,
                'prev_log_id' => $log->id,
                'created_at' => $log->created_at->add($delay),
                'updated_at' => $log->updated_at->add($delay)
            ]);
        }
    }
}
