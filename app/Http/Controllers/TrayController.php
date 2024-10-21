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
        $products = Product::all();
        return view('Orders.Menu', [
            'products' => $products
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
        $user = Auth::user();

        //Verificação se o novo item adicionado existe na tabela.
        $hasTray = DB::table('trays')->where('user_id','=', $user->id)->get();

        if (count($hasTray) == 0){
            $addTray = new Tray();
            $addTray->user_id = $user->id;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $request->ammount;
            $addTray->save();
        } else {
            $exist = false;
            foreach ($hasTray as $trayItem){
                if ($trayItem->product == $item->name){
                    DB::table('trays')
                        ->where('user_id','=', $user->id)
                        ->where('product','=', $item->name)
                        ->update(['ammount' => $trayItem->ammount += $request->ammount]);

                    $exist = true;
                }
            }
        if ($exist == false){
            $addTray = new Tray();
            $addTray->user_id = $user->id;
            $addTray->product = $item->name;
            $addTray->value = $item->price;
            $addTray->ammount = $request->ammount;
            $addTray->save();
        }
        }
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
