<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    function coupon(){
        $coupons=Coupon::all();
        return view('coupon.coupon',[
            'coupons'=>$coupons
        ]);
    }
    function coupon_store(Request $request){
        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'limit'=>$request->limit,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),

        ]);
        return back();
    }
}
