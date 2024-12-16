<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Tray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('Orders.Coupons', [
            'coupons' => $coupons
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->name = strtoupper($request->name);
        $coupon->products = $request->items;
        $coupon->type = $request->aplication;
        $coupon->limit = $request->limit;
        $coupon->role = $request->role;
        $coupon->used = 0;

        if ($request->type == "Frete grátis"){
            $coupon->discount == "Frete grátis";
        }else{
            $coupon->discount = $request->discount;
        }

        if ($request->is_available == "on"){
            $coupon->status = true;
        }else{
            $coupon->status = false;
        }

        $coupon->save();

        return redirect()->back();
    }

    public function apply(Request $request)
    {
        $user = Auth::user();
        $total = 0;
        $coupon = DB::table('coupons')
            ->where('name', $request->coupon)
            ->get();

        $firstTray = Tray::where('user_id', $user->id)
            ->first();

        $trays = Tray::where('user_id', $user->id)
            ->get();

        foreach ($trays as $tray){
            $total += $tray->value * $tray->ammount;
        }

        if ($total > $coupon[0]->role){
            $update = Tray::find($firstTray->id);
            $update->coupon_apply = $coupon[0]->name;
            $update->save();

            return redirect()->route('review')->with('msg-coupon-applyed', '.');
        }else{
            return redirect()->route('review')->with('msg-coupon-notApplyed', 'Falha ao aplicar o cupom '.$coupon[0]->name.'. Verifique as condições de uso.');
        }
    }

    public function remove()
    {
        $user = Auth::user();
        $firstTray = Tray::where('user_id', $user->id)
            ->first();

        $update = Tray::find($firstTray->id);
        $update->coupon_apply = null;
        $update->save();

        return redirect()->route('review')->with('msg-coupon-removed', '.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->name = strtoupper($request->name);
        $coupon->products = $request->items;
        $coupon->type = $request->aplication;
        $coupon->limit = $request->limit;
        $coupon->used = 0;

        if ($request->type == "Frete grátis"){
            $coupon->discount == "Frete grátis";
        }else{
            $coupon->discount = $request->discount;
        }

        if ($request->is_available == "on"){
            $coupon->status = true;
        }else{
            $coupon->status = false;
        }

        $coupon->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->back();
    }
}
