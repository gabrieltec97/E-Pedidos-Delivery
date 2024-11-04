<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

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
        $coupon = new Coupon();
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
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
