<?php

namespace App\Http\Controllers;

use App\Charts\AreaChart;
use App\Charts\MonthChart;
use App\Models\Product;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function monthConverter()
    {
        $mes = date('M');

        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

        return $mes_extenso["$mes"];
    }
    public function index(AreaChart $chart, MonthChart $chart2, Request $request)
    {

       //Filtro de vendas por mês.
       if (isset($request->month)){
           $monthName = $request->month;  // Nome do mês em português
           $year = 2025;            // O ano desejado

           // Array de meses em português
           $months = [
               'Janeiro' => 1,
               'Fevereiro' => 2,
               'Março' => 3,
               'Abril' => 4,
               'Maio' => 5,
               'Junho' => 6,
               'Julho' => 7,
               'Agosto' => 8,
               'Setembro' => 9,
               'Outubro' => 10,
               'Novembro' => 11,
               'Dezembro' => 12
           ];

           // Verifica se o nome do mês é válido e recupera o número do mês
           $month = isset($months[$monthName]) ? $months[$monthName] : null;

           if ($month) {
               // Usando cal_days_in_month para obter o número de dias do mês
               $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
           }

           $diasDoMes = [];

           for ($dia = 1; $dia <= $daysInMonth; $dia++) {
               $diasDoMes[] = $dia;
           }

           $totalSalesInThisDay = [];
           foreach ($diasDoMes as $dia) {
               $sales = DB::table('orders')
                   ->where('month', $request->month)
                   ->where('day', $dia)
                   ->where('status', 'Pedido Entregue')
                   ->count();

               $totalSalesInThisDay[] = $sales;
           }

           $day = [];
           for ($i = 1; $i <= $daysInMonth; $i++) {
               $day[] = $i;
           }

           $chart3 = new Chart();
           $chart3->labels($day);
           $chart3->dataset('Vendas em '. $request->month, 'line', $totalSalesInThisDay)
               ->backgroundColor('rgba(255, 99, 132, 0.2)');

       }else{

           //Capturando o mês atual.
           $numeroDeDias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); // CAL_GREGORIAN é o calendário padrão
           $diasDoMes = [];

           for ($dia = 1; $dia <= $numeroDeDias; $dia++) {
               $diasDoMes[] = $dia;
           }

           $totalSalesInThisDay = [];

          foreach ($diasDoMes as $dia) {
              $sales = DB::table('orders')
                  ->where('month', $this->monthConverter())
                  ->where('day', $dia)
                  ->where('status', 'Pedido Entregue')
                  ->count();

              $totalSalesInThisDay[] = $sales;
          }

           $day = [];
           for ($i = 1; $i <= $numeroDeDias; $i++) {
               $day[] = $i;
           }

           $chart3 = new Chart();
           $chart3->labels($day);
           $chart3->dataset('Vendas este mês', 'line', $totalSalesInThisDay)
               ->backgroundColor('rgba(255, 99, 132, 0.2)');
       }


        $lowstock = DB::table('products')->where('stock', '<', 15)->count();
        $todayOrders = DB::table('orders')
            ->where('status', 'Pedido Entregue')
            ->where('month', $this->monthConverter())
            ->where('day', date('d'))
            ->where('year', date('Y'))
            ->count();

        $todayAmmount = DB::table('orders')
            ->select('value')
            ->where('status', 'Pedido Entregue')
            ->where('month', $this->monthConverter())
            ->where('day', date('d'))
            ->where('year', date('Y'))
            ->get()->toArray();

        $ammount = 0;

        foreach ($todayAmmount as $today){
            $ammount += $today->value;
        }

        $items = DB::table('products')
            ->select('name')
            ->where('type','Comida')
            ->get();
        $totalItems = [];

        foreach ($items as $item) {
            $countItems = DB::table('order_items')
                ->select('ammount')
                ->where('product', $item->name)
                ->where('month', $this->monthConverter())
                ->get();
            $total = 0;
            foreach ($countItems as $countItem) {
                $total += $countItem->ammount;
            }
            array_push($totalItems, ['name' => $item->name, 'total' => $total]);
        }

        //Ordenando o array para ordem decrecente.
        $keys = array_column($totalItems, 'total');
        array_multisort($keys, SORT_DESC, $totalItems);

        $neighborhoods = DB::table('neighbourhoods')->select('name')->get();
        $countForPercent = DB::table('orders')->where('status', 'Pedido Entregue')->count();
        $totalOrders = [];

        foreach ($neighborhoods as $neighborhood){
            $count = DB::table('orders')->where('neighborhood', $neighborhood->name)->count();
            $totalNeighborhood = DB::table('orders')->where('neighborhood', $neighborhood->name)->sum('value');
            $percentOrders = ($count / $countForPercent) * 100;
            array_push($totalOrders, ['name' => $neighborhood->name, 'total' => $count,
                'porcentagem' => round($percentOrders,2), 'totalValue' => $totalNeighborhood]);
//            $totalOrders[$neighborhood->name] = $count;
        }

        //Ordenando o array para ordem decrecente.
        $keys = array_column($totalOrders, 'total');
        array_multisort($keys, SORT_DESC, $totalOrders);


        //Métricas para o dia em dinheiro e pedidos.
        $metDay = intval(date('d'));
        $metMonth = $this->monthConverter();

        function calcPercent($metDay, $metMonth){
            $salesDate = DB::table('orders')
                ->select('value')
                ->where('day', $metDay -1)
                ->where('month', $metMonth)
                ->where('status', 'Pedido Entregue')
                ->get();

            $valueYesterday = 0;
            foreach ($salesDate as $sale) {
                $valueYesterday += doubleval($sale->value);
            }

            $salesDateToday = DB::table('orders')
                ->select('value')
                ->where('day', date('d'))
                ->where('month', $metMonth)
                ->where('status', 'Pedido Entregue')
                ->get();

            $valueToday = 0;
            foreach ($salesDateToday as $sale) {
                $valueToday += doubleval($sale->value);
            }

            if ($valueYesterday != 0){
                $yesterday = $valueYesterday / 100;
                $today = $valueToday / 100;
                $percent = ($today - $yesterday) * 100;
                return round($percent, 2);
            }
        }

        if (date('d') > 1){
            $moneyMetrics = calcPercent($metDay, $metMonth);
        }

        return view('pages.dashboard', [
            'lowStock' => $lowstock,
            'chart' => $chart->build(),
            'chart3' => $chart3,
            'totalOrders' => $totalOrders,
            'totalItems' => $totalItems,
            'ammount' =>  number_format($ammount, 2, ',', '.'),
            'moneyMetrics' => $moneyMetrics,
            'orders' => $todayOrders
        ]);
    }
}
