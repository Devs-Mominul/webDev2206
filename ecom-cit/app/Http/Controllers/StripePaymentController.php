<?php

namespace App\Http\Controllers;

use App\Models\Stripe_orders;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $data=(session('data'));

         $stripe_id=Stripe_orders::insertGetId([
            'customer_id'=>$data['customer_id'],
            'fname'=>$data['fname'],
            'lname'=>$data['lname'],
            'country_id'=>$data['country'],
            'city_id'=>$data['city'],
            'zip'=>$data['zip'],
            'company'=>$data['company'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],

            'ship_fname'=>$data['ship_fname'],
            'ship_lname'=>$data['ship_lname'],
            'ship_country_id'=>$data['ship_country'],
            'ship_city_id'=>$data['ship_city'],
            'ship_zip'=>$data['ship_zip'],
            'ship_company'=>$data['ship_company'],
            'ship_email'=>$data['ship_email'],
            'ship_phone'=>$data['ship_phone'],
            'ship_address'=>$data['ship_address'],
            'charge'=>$data['charge'],
            'discount'=>$data['discount'],
            'sub_total'=>$data['sub_total'],
            'total'=>$data['total'],
            'ship_check'=>$data['ship_check'],
            'payment'=>$data['payment'],


            'message'=>$data['message'],
            'status'=>'Pending',
            'amount'=>$data['total'] + $data['charge'],


         ]);
         $stripe_amounts=Stripe_orders::all();

        return view('frontend.stripe',[
            'stripe_id'=>$stripe_id
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $stripe_id=$request->stripe_id;
        $data=Stripe_orders::find($stripe_id);
        $total=$data->first()->total;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100 * $total,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        return redirect()->route('product.order.success');


    }
}
