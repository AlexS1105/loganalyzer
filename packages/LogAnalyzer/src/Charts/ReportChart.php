<?php

declare(strict_types = 1);

namespace Alexxx007\LogAnalyzer\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class ReportChart extends BaseChart
{
    protected function fillEmpty($amounts)
    {
        if(count($amounts) > 0) {
            $dateFrom = new DateTime(array_key_first($amounts));
            $dateTo = new DateTime(array_key_last($amounts));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($dateFrom, $interval, $dateTo);

            foreach($period as $day) {
                $day = $day->format('Y-m-d');
                if(!array_key_exists($day, $amounts)) {
                    $amounts[$day] = 0;
                }
            }
        }

        uksort($amounts, function($a, $b) {
            return strtotime($a) - strtotime($b);
        });
    }

    protected function forecast($amounts)
    {
        $path = base_path().'\scripts\forecast.py';
        $json = json_encode($amounts);
        $fp = fopen(base_path().'\\scripts\\file.json', 'w');
        fwrite($fp, $json);
        fclose($fp);
        $process = new Process(['python', $path]);
        $process->run();
        $output = $process->getOutput();
        $decoded = json_decode($output);

        if($output != null) {
            $dateFrom = new DateTime(array_key_last($amounts));
            $dateTo = new DateTime(array_key_last($amounts));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($dateFrom->add(new DateInterval('P1D')), $interval, $dateTo->add(new DateInterval('P8D')));
            $forecast = [];
    
            foreach($period as $day) {
                $day = $day->format('Y-m-d');
                $forecast[$day] = max(round(array_shift($decoded)), 0);
            }
    
            return $forecast;
        }

        return [];
    }

    public function handler(Request $request): Chartisan
    {
        return Chartisan::build();
    }
}
