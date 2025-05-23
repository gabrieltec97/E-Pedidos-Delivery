<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Neighbourhood;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Tray;
use App\Services\UserIdentifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class TrayController extends Controller
{
    public function index(Request $request, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($request);
        $products = Product::all();
        $additionals = Additional::all();
        $burguers = DB::table('products')
            ->where('type', 'Comida')
            ->where('is_available', true)
            ->get();

        $drinks = DB::table('products')
            ->where('type', 'Bebida')
            ->where('is_available', true)
            ->get();

        $desserts = DB::table('products')
            ->where('type', 'Sobremesa')
            ->where('is_available', true)
            ->get();

        //Verificação se o item tem em estoque.
        foreach ($products as $key => $product){
            if ($product->type != 'Comida'){
               if ($product->stock <= 0 && $product->is_available){
                  $updateProduct = Product::find($product->id);
                  $updateProduct->is_available = false;
                  $updateProduct->save();

                  $checkNotification = DB::table('notifications')->where('item', $product->id)->get();

                  if (!isset($checkNotification[0])){
                      $notification = new Notification();
                      $notification->title = 'Produto Desativado.';
                      $notification->content = 'O item '. $updateProduct->name . ' foi desativado por baixa quantidade em estoque!';
                      $notification->type = 'Desativação';
                      $notification->item = $updateProduct->id;
                      $notification->save();
                  }

               }elseif ($product->stock <= 0 or !$product->is_available){
                    unset($products[$key]);
               }
            }
        }

        if ($user != null){
            $tray = DB::table('trays')
                ->where('user_id', $user)
                ->get();

            $total = DB::table('trays')
                ->select('ammount')
                ->where('user_id', $user)
                ->get(); // Conta o total de "ammount"

            $totalItems = 0;
            foreach ($total as $count){
                $totalItems += intVal($count->ammount);
            }
        }else{
            $tray = [];
            $totalItems = 0;
        }

        $deliveryStatus = DB::table('delivery_status')
            ->select('status')
            ->where('id', 1)->get();

        $status = '';
        if (isset($deliveryStatus[0])){
            if ($deliveryStatus[0]->status == 1){
                $status = true;
            }else{
                $status = false;
            }
        }else{
            $status = false;
        }

        $liveOrder = DB::table('orders')
            ->where('status', '!=', 'Pedido Entregue')
            ->where('status', '!=', 'Cancelado')
            ->where('user_id', $user)->get();

        $count = count($liveOrder);
        $items = '';
        $myOrder = '';
        $time = '';

        $orderItems = [];
        if (isset($liveOrder[0])){
           foreach ($liveOrder as $order){
               $items = DB::table('order_items')
                   ->where('user_id', $user)
                   ->where('order_id', $order->id)
                   ->get();

               $time = DB::table('neighbourhoods')
                   ->select('time')
                   ->where('name', $liveOrder[0]->neighborhood)->get();

               $time = $time[0]->time;

               foreach ($items as $item) {
                   array_push($orderItems, $item); // Adiciona o objeto $item ao array
               }
           }
            $myOrder = $liveOrder;
        }

        $historic = DB::table('orders')
            ->where('user_id', $user)->get();

        $historicItems =  $items = DB::table('order_items')
            ->where('user_id', $user)
            ->get();

        return view('Orders.Menu', [
            'burguers' => $burguers,
            'drinks' => $drinks,
            'desserts' => $desserts,
            'tray' => $tray,
            'totalItems' => $totalItems,
            'additionals' => $additionals,
            'status' => $status,
            'liveOrder' => $count,
            'items' => $items,
            'myOrder' => $myOrder,
            'orderItems' => $orderItems,
            'historic' => $historic,
            'historicItems' => $historicItems,
            'time' => $time,
            'user' => $user
        ]);
    }

    public function realTimeOrders(Request $request, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($request);
        $orders = DB::table('orders')
            ->where('user_id', $user)->get();

        return response()->json($orders);
    }

    public function checkTray(Request $userID, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($userID);
        $check = DB::table('trays')
            ->select('value')
            ->where('user_id', $user)
            ->count();

        return response()->json($check);
    }

    public function findPrice(Request $userID, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($userID);
        $values = DB::table('trays')
            ->select('value', 'ammount', 'neighbourhood', 'coupon_apply', 'sendingValue', 'additionals')
            ->where('user_id', $user)
            ->get();

        $additionalsValue = 0;
        foreach ($values as $value){
            $additionals = explode(',', $value->additionals);
            foreach ($additionals as $additional){
                $adValue = DB::table('additionals')
                    ->select('price')
                    ->where('name', ltrim($additional))
                    ->get();

                if (isset($adValue[0])){
                    $additionalsValue += $adValue[0]->price;
                }
            }
        }

        $total = 0;
        $sum = false;
        foreach ($values as $one){
            if ($one->neighbourhood != null){
                $neighbourhood = DB::table('neighbourhoods')
                    ->select('taxe', 'name', 'time')
                    ->where('name', $one->neighbourhood)
                    ->get();

                $total += floatval($one->value) * $one->ammount;
                $sum = true;
            }else{
                $total += floatval($one->value) * $one->ammount;
            }
        }

        $subtotal = $total;
        if ($sum){
            $total += floatval($neighbourhood[0]->taxe);
        }

        $discount = 0;
        $usedCoupon = null;

        //Verificando se tem cupom ativo.
        if($values[0]->coupon_apply != null){
            $coupon = DB::table('coupons')
            ->select('type', 'discount')
            ->where('name', $values[0]->coupon_apply)
            ->get();

            if($coupon[0]->type == 'Dinheiro'){
                $total -= $coupon[0]->discount;
            }elseif($coupon[0]->type == 'Porcentagem'){
                $total - ($total / $coupon[0]->discount);
            }else{
                $total -= $neighbourhood[0]->taxe;
            }

            $discount = $coupon[0]->type;
            $usedCoupon =$values[0]->coupon_apply;
        }

        if ($values[0]->sendingValue != null){
            $sendingValue = $values[0]->sendingValue;
        }else{
            $sendingValue = null;
        }

        $total += $additionalsValue;
        $subtotal += $additionalsValue;

        $time = false;
        if (isset($neighbourhood[0]->time)){
            $time = $neighbourhood[0]->time;
        }

        return response()->json(['total' => $total, 'subtotal' => $subtotal,
            'discount' => $discount, 'sendingValue' => $sendingValue,
            'usedCoupon' => $usedCoupon, 'time' => $time]);
    }

    public function taxeCalculator(Request $request, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($request);
        $tray = DB::table('trays')
            ->select('coupon_apply')
            ->where('user_id', $user)
            ->get();

            $discount = null;

            //Verificando se tem cupom ativo.
            if($tray[0]->coupon_apply != null){
                $coupon = DB::table('coupons')
                ->select('type')
                ->where('name', $tray[0]->coupon_apply)
                ->get();

                if($coupon[0]->type == 'Frete grátis'){
                    $discount = $coupon[0]->type;
                }
            }

        $local = $request->input('local');
        $neighborhoods = Neighbourhood::all();

        //Cálculo de taxa.
        $taxe = 'no';
        $time = false;
        foreach ($neighborhoods as $neighborhood){
            if ($neighborhood->name == $local){
                $taxe = $neighborhood->taxe;
                $time = $neighborhood->time;
            }
        }

        //Verificando se o local de entrega está disponível.
        $check2 = DB::table('neighbourhoods')
            ->select('is_available')
            ->where('name', $local)->get();

        if (isset($check2[0])){
            if ($check2[0]->is_available != true){
                $taxe = 'no';
            }
        }else{
            $taxe = 'no';
        }

        return response()->json(['taxe' => $taxe, 'discount' => $discount, 'time' => $time]);
    }

    public function refreshTray(Request $userID, UserIdentifierService $userIdentifierService){

        $user = $userIdentifierService->getUserIdentifier($userID);
        $tray = DB::table('trays')
              ->where('user_id', $user)
              ->get();

        return response()->json($tray);
    }

    public function removeItem(Request $userID, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($userID);
        DB::table('trays')
            ->where('user_id', $user)
            ->where('product', $userID->input('product_name'))
            ->delete();

        return response()->json(['success' => $userID->input('product_name') . ' foi removido da bandeja.']);
    }

    public function refreshAmmount(Request $userID, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($userID);
        $items = $userID->input('items');

        // Armazenar as quantidades no banco de dados
        foreach ($items as $item) {
            $productName = $item['product_name'];
            $ammount = $item['quantity'];

            DB::table('trays')
                ->where('user_id', $user)
                ->where('product', $productName)
                ->update(['ammount' => $ammount]);
        }

        return response()->json(['success' => 'sucesso']);
    }

    public function findData(Request $userID, UserIdentifierService $userIdentifierService){

        $user = $userIdentifierService->getUserIdentifier($userID);
        $tray = DB::table('trays')
              ->select('address', 'number', 'city', 'neighbourhood', 'name', 'contact', 'paymentMode', 'change')
              ->where('user_id', $user)
              ->get()->first();

        return response()->json($tray);
    }

    public function trackAddress(Request $request, UserIdentifierService $userIdentifierService){

        $user = $userIdentifierService->getUserIdentifier($request);
        $tray = DB::table('trays')
              ->select('id')
              ->where('user_id', $user)
              ->get();

        $neighbourhood = DB::table('neighbourhoods')
            ->select('taxe')
            ->where('name', $request->neighbourhood)
            ->get();

        $update = DB::table('trays')
        ->where('user_id', $user)
        ->update([
            'name' => ucwords(strtolower($request->name)),
            'cep' => $request->cep,
            'address' => $request->address,
            'neighbourhood' => $request->neighbourhood,
            'city' => $request->city,
            'complement' => $request->complement,
            'contact' => $request->contact,
            'number' => $request->number,
            'sendingValue' => $neighbourhood[0]->taxe,
        ]);

        return response()->json(['message' => 'sucesso!']);
    }

    public function addPaymentMode(Request $request, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($request);
        $tray = DB::table('trays')
            ->select('id')
            ->where('user_id', $user)
            ->get();

        if ($request->paymentMode == 'Dinheiro'){
            $change = $request->change;
        }else{
            $change = null;
        }

        $update = DB::table('trays')
            ->where('user_id', $user)
            ->update([
                'paymentMode' => $request->paymentMode,
                'change' => $change,
            ]);

        return response()->json(['message' => 'sucesso!']);
    }

    public function checkCoupon(Request $request, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($request);
        $tray = DB::table('trays')
            ->select('id', 'value', 'sendingValue', 'ammount')
            ->where('user_id', $user)
            ->get();

        $trayValue = 0;

            foreach($tray as $item){
                $trayValue += floatval( $item->value) * $item->ammount;
            }

            $coupon = DB::table('coupons')
                  ->where('name', $request->coupon)
                  ->get();

            $found = false;
            if (count($coupon) == 0){
                return response()->json(['found' => $found, 'message' => 'Não foi possivel encontrar este cupom.',
                    'heading' => 'Cupom não encontrado!']);
            }

            if (isset($coupon[0])){
                if ($coupon[0]->status == 0){
                    return response()->json(['message' => 'Infelizmente este cupom já foi utilizado em sua quantidade máxima de vezes.',
                        'heading' => 'Cupom indisponível!']);
                }
            }

            $error = false;
            $message = '';
            $heading = '';
            $usedCoupon = '';
            if($coupon[0]->role < $trayValue){
                DB::table('trays')
                ->where('user_id', $user)
                ->update(['coupon_apply' => $coupon[0]->name]);

                $message = 'O cupom '. $coupon[0]->name . ' foi aplicado com sucesso!';
                $found = true;
                $usedCoupon = $coupon[0]->name;
            }else{
                $error = true;
                $message =  'O cupom '. $coupon[0]->name . ' só pode ser utilizado para compras acima de '. $coupon[0]->role . ' reais.';
                $found = true;
                $heading = 'Não foi possível aplicar este cupom';
            }

            return response()->json(['found' => $found,
            'message' => $message, 'error' => $error,
            'type' => $coupon[0]->type, 'discount' => $coupon[0]->discount,
            'sendingValue' => $tray[0]->sendingValue, 'heading' => $heading,
            'usedCoupon' => $usedCoupon]);
    }


    public function removeCoupon(Request $request, UserIdentifierService $userIdentifierService){

        $user = $userIdentifierService->getUserIdentifier($request);
        $tray = DB::table('trays')
        ->select('id', 'value', 'sendingValue', 'ammount', 'additionals')
        ->where('user_id', $user)
        ->get();

        $trayValue = $tray[0]->sendingValue;
        $subtotal = 0;
        foreach($tray as $item){
            $subtotal += floatval($item->value) * $item->ammount;
        }

        //Capturando o valor dos adicionais.
        $additionalsValue = 0;
        foreach ($tray as $calcAd){
            $additionals = explode(',', $calcAd->additionals);
            foreach ($additionals as $additional){
                $adValue = DB::table('additionals')
                    ->select('price')
                    ->where('name', ltrim($additional))
                    ->get();

                if (isset($adValue[0])){
                    $additionalsValue += $adValue[0]->price;
                }
            }
        }

        $subtotal += $additionalsValue;
        $trayValue = $tray[0]->sendingValue + $subtotal;

        DB::table('trays')
        ->where('user_id', $user)
        ->update(['coupon_apply' => null]);

        return response()->json(['message' => 'Cupom removido com sucesso!', 'value' => $trayValue,
            'taxe' => $tray[0]->sendingValue, 'subtotal' => $subtotal]);
    }

    public function store(Request $request)
    {
        $status = DB::table('delivery_status')
            ->select('status')
            ->where('id', 1)->get();

        if ($status[0]->status == false){
            return response()->json([
                'success' => false,
                'message' => 'Infelizmente não estamos recebendo pedidos no momento. Tente novamente mais tarde!'
            ], 400);
        }

        $item = Product::find($request->input('productId'));

        //Recuperando os adicionais.
        $additionals = '';
        if ($request->additionals != null){
            foreach ($request->additionals as $itemAd){
                $itemName = DB::table('additionals')
                    ->select('name')
                    ->where('id', $itemAd)
                    ->get();

                if ($additionals == ''){
                    $additionals =$itemName[0]->name;
                }else{
                    $additionals = $additionals . ', ' . $itemName[0]->name;
                }
            }
        }else{
            $additionals = null;
        }

        //Correção de item vindo nulo do frontend.
        if($request->ammount == null){
            $ammount = 1;
        }else{
            $ammount = $request->ammount;
        }

        //Verificação de estoque baixo.
        if ($item->stock != null){
            if ($request->ammount > $item->stock){
                return response()->json([
                    'success' => false,
                    'message' => 'Não é possível adicionar ' . $request->ammount . ' unidades de ' . $item->name . ' na bandeja.'
                ], 400);
            }
        }

        if (Auth::user() == null){
            if (!$request->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid( true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $request->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

        //Verificação se o novo item adicionado existe na tabela.
        $hasTray = DB::table('trays')->where('user_id','=', $user)->get();

        if (count($hasTray) == 0){
            $addTray = new Tray();
            $addTray->user_id = $user;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $ammount;
            $addTray->comments = $request->comments;
            $addTray->product_id = $item->id;
            $addTray->picture = $item->picture;
            $addTray->additionals = $additionals;
            $addTray->save();

        }else {
            $exist = false;
            foreach ($hasTray as $trayItem){
                if ($trayItem->product == $item->name){
                    DB::table('trays')
                        ->where('user_id','=', $user)
                        ->where('product','=', $item->name)
                        ->update(['ammount' => $trayItem->ammount += $ammount]);

                    DB::table('trays')
                        ->where('user_id','=', $user)
                        ->where('product','=', $item->name)
                        ->update(['value' => floatval($item->price)]);

                    $exist = true;
                }
            }
        if ($exist == false){
            $addTray = new Tray();
            $addTray->user_id = $user;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $ammount;
            $addTray->product_id = $item->id;
            $addTray->comments = $request->comments;
            $addTray->picture = $item->picture;
            $addTray->additionals = $additionals;
            $addTray->save();
        }
        }
        return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso!']);
    }

    public function count(Request $userID, UserIdentifierService $userIdentifierService)
    {
        $user = $userIdentifierService->getUserIdentifier($userID);
        $total = DB::table('trays')
            ->select('ammount')
            ->where('user_id', $user)
            ->get(); // Conta o total de "ammount"

        $totalItems = 0;
        foreach ($total as $count){
            $totalItems += intVal($count->ammount);
        }
        return response()->json(['count' => $totalItems]);
    }

    public function update(Request $request, string $id)
    {
        $tray = Tray::find($id);
        if ($request->ammount != 0){
            $item = Product::find($tray->product_id);
            $tray->value = floatval($item->price);
            $tray->ammount = $request->ammount;
            $tray->save();
        }else{
            $tray->delete();
        }

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $item = Tray::find($id);
        $item->delete();

        $check = DB::table('trays')
            ->where('user_id', $user->id)
            ->count();

        if ($check == 0){
            return redirect(route('cardapio.index'));
        }else{
            return redirect()->back();
        }
    }
}
