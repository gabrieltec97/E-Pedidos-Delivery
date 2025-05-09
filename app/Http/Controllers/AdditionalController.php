<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdditionalController extends Controller
{
    public function index()
    {
        $registereds = Additional::all();
        $foods = DB::table('products')->select('name')->where('type', 'Comida')->get();
        $drinks = DB::table('products')->select('name')->where('type', 'Bebida')->get();
        $desserts = DB::table('products')->select('name')->where('type', 'Sobremesa')->get();

        return view('Products.Additionals.newAdditional', [
            'registereds' => $registereds,
            'foods' => $foods,
            'drinks' => $drinks,
            'desserts' => $desserts
        ]);
    }

    public function store(Request $request)
    {
        return redirect()->route('adicionais.index');

        $additional = new Additional();
        $additional->name = $request->name;
        $additional->type = $request->type;
        $additional->price = $request->price;

        if ($request->is_available == "on"){
            $additional->is_available = true;
        }else{
            $additional->is_available = false;
        }

        $additional->save();
        return redirect()->back()->with('msg-ok', 'ok');
    }
    public function update(Request $request, string $id)
    {
        return redirect()->route('adicionais.index');

        $additional = Additional::find($id);
        $additional->name = $request->name;
        $additional->type = $request->type;
        $additional->price = $request->price;

        if ($request->is_available == "on"){
            $additional->is_available = true;
        }else{
            $additional->is_available = false;
        }

        $additional->save();
        return redirect()->back()->with('msg-upd', 'ok');
    }

    public function destroy(string $id)
    {
        return redirect()->route('adicionais.index');

        $item = Additional::find($id);
        $item->delete();
        return redirect()->back()->with('msg', 'ok');
    }
}
