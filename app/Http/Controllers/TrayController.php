<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use App\Models\Product;
use App\Models\Tray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class TrayController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user() == null){
            if (!$request->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

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

        $products = Product::all();
        $burguers = DB::table('products')
            ->where('type', 'Comida')
            ->get();

        $drinks = DB::table('products')
            ->where('type', 'Bebida')
            ->get();

        $desserts = DB::table('products')
            ->where('type', 'Sobremesa')
            ->get();

        //Verificação se o item tem em estoque.
        foreach ($products as $key => $product){
            if ($product->type != 'Comida'){
               if ($product->stock <= 0 && $product->is_available){
                  $updateProduct = Product::find($product->id);
                  $updateProduct->is_available = false;
                  $updateProduct->save();
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

        return view('Orders.draftMenu', [
            'burguers' => $burguers,
            'drinks' => $drinks,
            'desserts' => $desserts,
            'tray' => $tray,
            'totalItems' => $totalItems
        ]);
    }

    public function checkTray(Request $userID)
    {
        if (Auth::user() == null){
            if (!$userID->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $userID->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

        $check = DB::table('trays')
            ->select('value')
            ->where('user_id', $user)
            ->count();

        return response()->json($check);
    }


    public function findPrice(Request $userID)
    {
        if (Auth::user() == null){
            if (!$userID->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $userID->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

        $values = DB::table('trays')
            ->select('value', 'ammount', 'neighbourhood')
            ->where('user_id', $user)
            ->get();

        $total = 0;
        $sum = false;
        foreach ($values as $one){
            if ($one->neighbourhood != null){
                $neighbourhood = DB::table('neighbourhoods')
                    ->select('taxe', 'name')
                    ->where('name', $one->neighbourhood)
                    ->get();

                $total += floatval($one->value) * $one->ammount;
                $sum = true;
            }else{
                $total += floatval($one->value) * $one->ammount;
            }
        }
        if ($sum){
            $total += floatval($neighbourhood[0]->taxe);
        }

        return response()->json($total);
    }
    public function taxeCalculator(Request $request)
    {
        if (Auth::user() == null){
            if (!$request->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

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

        $local = $request->input('local');

        $neighborhoods = Neighbourhood::all();

        //Cálculo de taxa.
        $taxe = 'no';
        foreach ($neighborhoods as $neighborhood){
            if ($neighborhood->name == $local){
                $taxe = $neighborhood->taxe;
            }
        }

        return response()->json($taxe);
    }

    public function refreshTray(Request $userID){

        if (Auth::user() == null){
            if (!$userID->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $userID->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

        $tray = DB::table('trays')
              ->where('user_id', $user)
              ->get();

        return response()->json($tray);
    }

    public function findAddress(Request $userID){

        if (Auth::user() == null){
            if (!$userID->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $userID->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

        $tray = DB::table('trays')
              ->select('address', 'number', 'city', 'neighbourhood')
              ->where('user_id', $user)
              ->get()->first();

              return response()->json($tray);
    }


    public function trackAddress(Request $request){

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

        $tray = DB::table('trays')
              ->select('id')
              ->where('user_id', $user)
              ->get();

        $update = DB::table('trays')
        ->where('user_id', $user)  // Condição para selecionar o registro com user_id = 5
        ->update([
            'name' => $request->name,  // Atualizando o campo1
            'cep' => $request->cep,  // Atualizando o campo1
            'address' => $request->address,  // Atualizando o campo1
            'neighbourhood' => $request->neighbourhood,  // Atualizando o campo2
            'city' => $request->city,
            'complement' => $request->complement,
            'contact' => $request->contact,
            'number' => $request->number,  // Atualizando o campo3
        ]);

        return response()->json(['message' => 'sucesso!']);
    }

    public function addPaymentMode(Request $request)
    {
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

    public function store(Request $request)
    {
        $item = Product::find($request->input('productId'));

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
            $addTray->product_id = $item->id;
            $addTray->save();

        } else {
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
            $addTray->save();
        }
        }
        return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso!']);
    }

    public function count(Request $userID)
    {
        if (Auth::user() == null){
            if (!$userID->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid('user_', true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            $user = $userID->cookie('user_identifier');
        }else{
            $user = Auth::user()->id;
        }

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
