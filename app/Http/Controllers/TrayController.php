<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $items = DB::table('trays')->where('user_id', $user->id)->count();

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
        return view('Orders.Menu', [
            'products' => $products,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Product::find($request->productId);

        //Verificação de estoque baixo.
        if ($item->stock != null){
            if ($request->ammount > $item->stock){
                return redirect()->route('cardapio.index')->with('msg-error', 'Não é possível adicionar '. $request->ammount . ' unidades de ' . $item->name. ' na bandeja.');
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
                        ->update(['value' => floatval($trayItem->value) + (floatval($item->price) * floatval($request->ammount))]);

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
        return redirect()->route('cardapio.index')->with('msg-success', 'Item adicionado à sua bandeja. Temos várias outras comidas deliciosas para você!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tray = Tray::find($id);

        if ($request->ammount != 0){
            $item = Product::find($tray->product_id);
            $tray->value = floatval($request->ammount) * floatval($item->price);
            $tray->ammount = $request->ammount;
            $tray->save();
        }else{
            $tray->delete();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
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
