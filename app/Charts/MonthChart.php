<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use app\Controllers\HomeController;

class MonthChart
{
    protected $chart2;

    public $month;

    public function __construct(LarapexChart $chart2)
    {
        $this->chart2 = $chart2;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {




        return $this->chart2->areaChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45,55,54,5465,6,65,65,65,65,65,65,65,65,65,0,54,045,45,0,0]);
//            ->setXAxis($field);
    }
}
