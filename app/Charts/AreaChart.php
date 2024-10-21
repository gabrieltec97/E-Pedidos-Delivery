<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class AreaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        if (date("m") == '01'){
            $meses = ['Janeiro'];
        }elseif (date("m") == '02'){
            $meses = ['Janeiro', 'Fevereiro'];
        }elseif (date("m") == '03'){
            $meses = ['Janeiro', 'Fevereiro', 'Março'];
        }elseif (date("m") == '04'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril'];
        }elseif (date("m") == '05'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'];
        }elseif (date("m") == '06'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'];
        }elseif (date("m") == '07'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'];
        }elseif (date("m") == '08'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto'];
        }elseif (date("m") == '09'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro'];
        }elseif (date("m") == '10'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro'];
        }elseif (date("m") == '11'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro'];
        }elseif (date("m") == '12'){
            $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        }

        $janeiro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Janeiro')
            ->count();

        $fevereiro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Fevereiro')
            ->count();

        $março = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Março')
            ->count();

        $abril = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Abril')
            ->count();

        $maio = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Maio')
            ->count();

        $junho = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Junho')
            ->count();

        $julho = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Julho')
            ->count();

        $agosto = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Agosto')
            ->count();

        $setembro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Setembro')
            ->count();

        $outubro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Outubro')
            ->count();

        $novembro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Novembro')
            ->count();

        $dezembro = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', 'Dezembro')
            ->count();



        return $this->chart->areaChart()
            ->setTitle('Comparativo ao longo dos meses.')
            ->setSubtitle('Total de vendas em cada mês.')
            ->addData('Total de vendas', [$janeiro, $fevereiro, $março, $abril, $maio, $junho, $julho, $agosto, $setembro, $outubro])
//            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis($meses);
    }
}
