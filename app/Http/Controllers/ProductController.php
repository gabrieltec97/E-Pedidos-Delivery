<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('Products.products-management', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = DB::table('products')
            ->where('name', 'like', '%'.$request->name.'%')
            ->count();

        if ($check >= 1){
            return redirect()->back()->with('msg-error','Já temos um produto cadastrado com o nome '.$request->name.'.');
        }

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
            if ($request->stock == 0){
                $product->is_available = false;
                $product->stock = $request->stock;
            }else{
                $product->stock = $request->stock;
            }
        }

        $product->save();

        return redirect()->route('produtos.index')->with('msg', $request->name.' foi cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
//
//
//            $check = DB::table('additionals')
//                ->select('products')
//                ->where('id', $item)
//                ->get()->toArray();
//
//            print_r($check);
//
//            die();
//
//            if ($check[0]->products != null){
//                $exist = explode(',', $check[0]->products);
//
//                if (!in_array($product->id, $exist)){
//                    array_push($exist, $product->id);
//                }
//
//                $updateCol = implode(",", $exist);
//            }else{
//                $updateCol = $product->id;
//            }
////
////            DB::table('additionals')
////                ->where('id', $item)
////                ->update(['products' => $updateCol]);
//        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->additionals = $additionals;

        if ($request->is_available == "on"){
            $product->is_available = true;
        }else{
            $product->is_available = false;
        }

        if ($product->type != "Comida"){
            if ($request->stock == 0){
                $product->is_available = false;
                $product->stock = $request->stock;
            }else{
                $product->stock = $request->stock;
            }
        }

        $product->save();
        return redirect()->back()->with('msg-updated', '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('produtos.index')->with('msg-removed', '.');
    }
}
