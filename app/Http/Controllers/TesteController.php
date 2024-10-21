<?php

namespace App\Http\Controllers;

use App\Charts\AreaChart;

class TesteController extends Controller
{
    public function teste(AreaChart $chart)
    {
        return view('teste', ['chart' => $chart->build()]);
    }
}
