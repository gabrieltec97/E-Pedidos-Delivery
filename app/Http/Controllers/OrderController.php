<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Neighbourhood;
use App\Models\OrderItems;
use App\Models\Product;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = DB::table('orders')
            ->where('status', '!=', 'Cancelado')
            ->where('status', '!=', 'Pedido Entregue')
            ->get()->toArray();

        $info = [];

        foreach ($orders as $order){
            $items = DB::table('order_items')
                ->where('order_id', $order->id)
                ->get()->toArray();

            $product = '';

            foreach ($items as $item){
                if ($product == ''){
                    $product = $item->product;
                }else{
                    $product = $product . ',' . $item->product . ' - ' . $item->ammount . ' item(s)';
                }
            }
            array_push($info, ['id' => $order->id, 'items' => $product, 'value' => $order->value,
                'address' => $order->userAdress, 'neighborhood' => $order->neighborhood,
                'client' => $order->user_name, 'date' => $order->created_at, 'status' => $order->status]);
        }

        return view('Orders.live-orders', [
            'info' => $info
        ]);
    }

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

    public function review()
    {
        $user = Auth::user();
        $neighborhoods = Neighbourhood::all();
        $items = DB::table('trays')->where('user_id', $user->id)->get();
        $total = 0;

       foreach ($items as $item){
           $total += $item->value;
       }

        return view('Orders.Review', [
            'user' => $user,
            'items' => $items,
            'neighborhoods' => $neighborhoods,
            'total' => $total
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $user = Auth::user();
        $tray = DB::table('trays')->where('user_id', $user->id)->get();

        //Evitando bug de criação de pedido errôneo.
        if (count($tray) == 0){
            return redirect()->back();
        }else{
            //Verificação para evitar ids duplicados.
            $id = mt_rand(1,9000);
            $checkId = Order::find($id);

            if ($checkId != null){
                while($id == $checkId->id){
                    $id = mt_rand(1,9000);
                }
            }

            //Capturando valor.
            $value = 0;

            foreach ($tray as $t){
                $value += $t->value;

                $item = new OrderItems();
                $item->user_id = $user->id;
                $item->order_id = $id;
                $item->product = $t->product;
                $item->ammount = $t->ammount;
                $item->value = $t->value;
                $item->address = $user->address;
                $item->neighbourhood = $user->neighbourhood;
                $item->user_name = $user->firstname . " " . $user->lastname;
                $item->month = $this->monthConverter();
                $item->save();

                //Abatendo do estoque.
                $itemSub = DB::table('products')
                    ->select('type', 'stock')
                    ->where('name', $t->product)
                    ->get();

                if ($itemSub[0]->type != 'Comida'){

                    $updStock = $itemSub[0]->stock -= $t->ammount;
                    DB::table('products')
                        ->where('name', $t->product)
                        ->update(['stock' => $updStock]);
                }
            }

            $order = new Order();
            $order->id = $id;
            $order->user_id = $user->id;
            $order->status = 'Novo Pedido';
            $order->value = $value;
            $order->month = $this->monthConverter();
            $order->day = date("j");
            $order->year = date("Y");
            $order->userAdress = $user->address;
            $order->neighborhood = $user->neighbourhood;
            $order->user_name = $user->firstname . " " . $user->lastname;
            $order->save();

            //Limpando bandeja.
            DB::table('trays')->where('user_id', $user->id)->delete();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(string $id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, string $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
