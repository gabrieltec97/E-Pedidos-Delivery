<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrayController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();

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
        return view('Orders.draftMenu', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $item = Product::find($request->input('productId'));

        //Verificação de estoque baixo.
        if ($item->stock != null){
            if ($request->ammount > $item->stock){
                return response()->json([
                    'success' => false,
                    'message' => 'Não é possível adicionar ' . $request->ammount . ' unidades de ' . $item->name . ' na bandeja.'
                ], 400);
            }
        }
        $user = Auth::user();

        //Verificação se o novo item adicionado existe na tabela.
        $hasTray = DB::table('trays')->where('user_id','=', $user->id)->get();

        if (count($hasTray) == 0){
            $addTray = new Tray();
            $addTray->user_id = $user->id;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $request->ammount;
            $addTray->product_id = $item->id;
            $addTray->save();
        } else {
            $exist = false;
            foreach ($hasTray as $trayItem){
                if ($trayItem->product == $item->name){
                    DB::table('trays')
                        ->where('user_id','=', $user->id)
                        ->where('product','=', $item->name)
                        ->update(['ammount' => $trayItem->ammount += $request->ammount]);

                    DB::table('trays')
                        ->where('user_id','=', $user->id)
                        ->where('product','=', $item->name)
                        ->update(['value' => floatval($item->price)]);

                    $exist = true;
                }
            }
        if ($exist == false){
            $addTray = new Tray();
            $addTray->user_id = $user->id;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $request->ammount;
            $addTray->product_id = $item->id;
            $addTray->save();
        }
        }
        return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso!']);
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
