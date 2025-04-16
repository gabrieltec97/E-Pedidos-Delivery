<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('Products.products-management', [
            'products' => $products
        ]);
    }

    public function checkProductName(Request $request)
    {
       $check = DB::table('products')
           ->select('id')
           ->where('name', $request->name)->count();

       if ($check != 0){
           return response()->json(['success' => false]);
       }else{
           return response()->json(['success' => true]);
       }
    }

    public function create()
    {
        return view('Products.new-product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $additionals = Additional::all();

        return view('Products.product', [
            'product' => $product,
            'additionals' => $additionals
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|min:3',
        ],[
            'name.required' => 'Insira um nome para o produto.',
            'name.min' => 'O nome do produto deve conter no mínimo 3 caracteres.',
            'price.required' => 'Insira valor para o produto.',
            'price.min' => 'O valor do produto deve conter no mínimo 3 caracteres.',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->is_available == "on"){
            $product->is_available = true;
        }else{
            $product->is_available = false;
        }

        if ($request->type != 'Comida'){

            $request->validate([
                'stock' => 'required',
            ],[
                'stock.required' => 'Insira a quantidade que este produto tem em estoque',
            ]);

            if ($request->stock == 0){
                $product->is_available = false;
                $product->stock = $request->stock;
            }else{
                $product->stock = $request->stock;
            }
        }

        // Valida se o arquivo é uma imagem
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Verifica se um arquivo foi enviado
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads', $imageName);

            $product->picture = $imageName;
        }

        $product->save();

        return redirect()->route('produtos.index')->with('msg', $request->name.' foi cadastrado com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|min:3',
        ],[
            'name.required' => 'Insira um nome para o produto.',
            'name.min' => 'O nome do produto deve conter no mínimo 3 caracteres.',
            'price.required' => 'Insira valor para o produto.',
            'price.min' => 'O valor do produto deve conter no mínimo 3 caracteres.',
        ]);

        $additionals = '';

        if (isset($request->additionals)){
            foreach ($request->additionals as $item) {

                if ($additionals == '') {
                    $additionals = $item;
                } else {
                    $additionals = $additionals . ',' . $item;
                }
            }
        }else {
            $additionals = null;
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->additionals = $additionals;

        if ($request->is_available == "on"){
            $product->is_available = true;

            $checkNotification = DB::table('notifications')->where('item', $id)->count();
            if ($checkNotification != 0){
                DB::table('notifications')
                    ->where('item', $id)
                    ->delete();
            }
        }else{
            $product->is_available = false;

            $notification = new Notification();
            $notification->title = 'Produto Inativo.';
            $notification->content = 'O item '. $request->name . ' foi alterado para inativo no cardápio!';
            $notification->type = 'Inativação';
            $notification->item = $product->id;
            $notification->save();
        }

        if ($product->type != "Comida"){

            $request->validate([
                'stock' => 'required|min:1',
            ],[
                'stock.required' => 'Insira a quantidade que este produto tem em estoque',
                'stock.min' => 'A quantidade mínima deve ser de pelo menos 1 produto.',
            ]);

            if ($request->stock == 0){
                $product->is_available = false;
                $product->stock = $request->stock;
            }else{
                $product->stock = $request->stock;
            }
        }

        // Verifica se um arquivo foi enviado
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads', $imageName);

            $product->picture = $imageName;
        }

        $product->save();
        return redirect()->back()->with('msg-updated', '.');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        if ($product->picture) {
            Storage::delete('public/uploads/' . $product->picture);
        }
        return redirect()->route('produtos.index')->with('msg-removed', '.');
    }
}
