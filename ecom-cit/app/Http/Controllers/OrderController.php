<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    function order(){
        $orders=Order::latest()->get();

        return view('layouts.order.order',[
            'orders'=>$orders

        ]);

    }
    function order_active(Request $request){
        Order::where('order_id',$request->order_id)->update([
         'status'=>$request->status,

        ]);
     }
}
