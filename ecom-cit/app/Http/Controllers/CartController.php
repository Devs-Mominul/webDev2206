<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    function cart_store(Request $request){
        Cart::insert([
         'customer_id'=>Auth::guard('customer')->id(),
         'product_id'=>$request->product_id,
         'color_id'=>$request->color_id,
         'size_id'=>$request->size_id,
         'quantity'=>$request->quantity,

        ]);
        return back()->with('cart_success','Card Added Successfully');
     }
     function  carts(Request $request){
        $coupon=$request->coupon_name;
        $msg='';
        $type='';
        $discount=0;
        if(isset($coupon)){
            if(Coupon::where('coupon_name',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_name',$coupon)->first()->validity){
                    if(Coupon::where('coupon_name',$coupon)->first()->limit !=0){
                        $type=Coupon::where('coupon_name',$coupon)->first()->type;
                        $discount=Coupon::where('coupon_name',$coupon)->first()->amount;

                    }
                    else{
                        $msg='coupon code limit exists';

                    }


                }
                else{
                    $msg='coupon code expored!';
                    $discount=0;



                }


            }
            else{
                $msg='Invalid Coupon Code!';
                $discount=0;

            }
        }
        $carts=Cart::where('customer_id',Auth::guard('customer')->id())->get();
        return view('frontend.customer.cart',[
            'carts'=>$carts,
            'msg'=>$msg,
            'discount'=>$discount,
            'type'=>$type,
        ]);
     }
     function cart_update(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);
        }


    }

}
