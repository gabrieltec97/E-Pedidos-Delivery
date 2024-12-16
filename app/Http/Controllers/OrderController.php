<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Neighbourhood;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Tray;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('Orders.live-orders');
    }

    public function getPedidosJson()
    {
        $data = DB::table('orders')
            ->where('status', '!=', 'Cancelado')
            ->where('status', '!=', 'Pedido Entregue')
            ->get()->toArray();

        $orders = [];

        foreach ($data as $order){
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
            array_push($orders, ['id' => $order->id, 'items' => $product, 'value' => $order->value,
                'address' => $order->userAdress, 'neighborhood' => $order->neighborhood,
                'client' => $order->user_name, 'date' => $order->created_at, 'status' => $order->status]);
        }

        return response()->json($orders);
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

        if (count($items) == 0){
            return redirect(route('cardapio.index'))->with('msg-add', 'Sua bandeja está vazia. Adicione itens do cardápio!');
        }
        $total = 0;

        foreach ($neighborhoods as $neighborhood){
            if ($neighborhood->name == $user->neighbourhood){
                $taxe = floatval($neighborhood->taxe);
                $taxe = number_format($taxe, 2, '.', '');
            }
        }

       foreach ($items as $item){
           $total += $item->value * $item->ammount;
       }

       if ($taxe != 0){
           $total += $taxe;
       }

       //Verificando desconto.
        $firstTray = Tray::where('user_id', $user->id)
            ->first();

        if ($firstTray->coupon_apply != null){
            $coupon = DB::table('coupons')
                ->where('name', $firstTray->coupon_apply)
                ->get();

            //Verificando o tipo de cupom.
            if ($coupon[0]->type == 'Porcentagem'){
                $percent = floatval('0.'. floatval($coupon[0]->discount));
                $total -= $total * $percent;
            }elseif ($coupon[0]->type == 'Frete grátis'){
                $total -= $taxe;
            }else{
                $total -= floatval($coupon[0]->discount);
            }
        }

        $total = number_format($total, 2, ',', '');
        $apllyied = $firstTray->coupon_apply;

        //Verificação de tipo de cupom.
        if (isset($coupon)){
            $couponType = $coupon[0]->type;
        }else{
            $couponType = null;
        }

       if ($total != 0){

           return view('Orders.Review', [
               'user' => $user,
               'items' => $items,
               'neighborhoods' => $neighborhoods,
               'total' => $total,
               'taxe' => $taxe,
               'coupon' => $apllyied,
               'type' => $couponType
           ]);
       }else{
           return redirect(route('cardapio.index'));
       }
    }

    public function store()
    {
        $user = Auth::user();
        $tray = DB::table('trays')->where('user_id', $user->id)->get();
        $neighborhoods = Neighbourhood::all();

        //Verificação se o produto tem em estoque.
        foreach ($tray as $Titem){
            $item = DB::table('products')->where('name', $Titem->product)->get();

            if ($item[0]->type != 'Comida'){
                if ($Titem->ammount > $item[0]->stock){
                    $disableItem = Product::find($item[0]->id);
                    $disableItem->is_available = false;
                    $disableItem->save();

                    $deleteItem = Tray::find($Titem->id);
                    $deleteItem->delete();

                    $refreshTray = DB::table('trays')->where('user_id', $user->id)->count();

                    if ($refreshTray != 0){
                        return redirect()->back()->with('ammount-error', 'Não é possível adicionar '.$Titem->ammount.' unidades de '. $item[0]->name. '. Com isso, excluímos este item de sua bandeja.');
                    }else{
                        return redirect()->route('cardapio.index')->with('error-no-stock', 'Não é possível adicionar '.$Titem->ammount.' unidades de '. $item[0]->name. '. Escolha outro produto do cardápio.');
                    }
                }
            }
        }

        //Cálculo de taxa.
        foreach ($neighborhoods as $neighborhood){
            if ($neighborhood->name == $user->neighbourhood){
                $taxe = $neighborhood->taxe;
            }
        }
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
                $value += $t->value * $t->ammount;

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

            //Verificando desconto.
            $firstTray = Tray::where('user_id', $user->id)
                ->first();

            if ($firstTray->coupon_apply != null){
                $coupon = DB::table('coupons')
                    ->where('name', $firstTray->coupon_apply)
                    ->get();

                //Verificando o tipo de cupom.
                if ($coupon[0]->type == 'Porcentagem'){
                    $percent = floatval('0.'. floatval($coupon[0]->discount));
                    $value -= $value * $percent;
                }elseif ($coupon[0]->type == 'Frete grátis'){
                    $value -= $taxe;
                }else{
                    $value -= floatval($coupon[0]->discount);
                }

                //Atualizando tabela de cupons.
                $use = $coupon[0]->used + 1;
                $updateCoupons = Coupon::find($coupon[0]->id);
                $updateCoupons->used = $use;
                $updateCoupons->save();
            }

            $order = new Order();
            $order->id = $id;
            $order->user_id = $user->id;
            $order->status = 'Novo Pedido';
            $order->value = $value + $taxe;
            $order->month = $this->monthConverter();
            $order->day = date('d');
            $order->year = date("Y");
            $order->userAdress = $user->address;
            $order->neighborhood = $user->neighbourhood;
            $order->user_name = $user->firstname . " " . $user->lastname;
            $order->save();

            //Limpando bandeja.
            DB::table('trays')->where('user_id', $user->id)->delete();

            return redirect()->route('cardapio.index');
        }
    }
    public function updateStatus(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($request->status == 'Em rota de entrega'){
           $order->delivery_man = $request->entregador_name;
        }
        $order->status = $request->status;
        $order->save();

        return redirect()->route('pedidos.index');
    }
}
