<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use  PDF;


class CustomerAuthController extends Controller
{
    function customer_register(){
        return view('frontend.customer.register');
    }
    function customer_login(){
        return view('frontend.customer.login');
    }
    function customer_register_store(Request $request){
        $request->validate([
            'fname' => 'required',
            'fname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
        Customer::insert([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),



        ]);
        return  redirect()->route('index');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    function customer_login_store(Request $request){
        if(Customer::where('email',$request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('index');
             }
             else{
                 return back();

             }
        }
        else{
            return redirect()->route('customer.login');
        }

    }
    function customer_profile(){
        return view('frontend.customer.profile');
    }
    function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect('/');

    }
    function cart_store(Request $request){
        print_r($request->all());
    }


    function customer_update(Request $request){
        if($request->password==''){
         if($request->photo==''){
             Customer::find(Auth::guard('customer')->id())->update([
                 'fname'=>$request->fname,
                 'lname'=>$request->lname,
                 'email'=>$request->email,
                 'phone'=>$request->phone,
                 'country'=>$request->country,
                 'zip'=>$request->zip,
                 'address'=>$request->address,


             ]);
         }
         else{
             $image=$request->photo;
             $extension=$image->extension();
             $file_name= Auth::guard('customer')->id().'.'.$extension;
             $photo=Image::make($image)->save(public_path('uploads/profile/'.$file_name));
             Customer::find(Auth::guard('customer')->id())->update([
                 'fname'=>$request->fname,
                 'lname'=>$request->lname,
                 'email'=>$request->email,
                 'phone'=>$request->phone,
                 'country'=>$request->country,
                 'zip'=>$request->zip,
                 'address'=>$request->address,
                 'photo'=>$file_name,


             ]);




            }

        }
        else{
         if($request->photo==''){
             Customer::find(Auth::guard('customer')->id())->update([
                 'fname'=>$request->fname,
                 'lname'=>$request->lname,
                 'email'=>$request->email,
                 'password'=>bcrypt($request->password),
                 'phone'=>$request->phone,
                 'country'=>$request->country,
                 'zip'=>$request->zip,
                 'address'=>$request->address,



             ]);

         }
         else{
             $image=$request->photo;
             $extension=$image->extension();
             $file_name= Auth::guard('customer')->id().'.'.$extension;
             $photo=Image::make($image)->save(public_path('uploads/profile/'.$file_name));
             Customer::find(Auth::guard('customer')->id())->update([
                 'fname'=>$request->fname,
                 'lname'=>$request->lname,
                 'email'=>$request->email,
                 'password'=>bcrypt($request->password),
                 'phone'=>$request->phone,
                 'country'=>$request->country,
                 'zip'=>$request->zip,
                 'address'=>$request->address,
                 'photo'=>$file_name,


             ]);
         }


        }

     }
     function order(){
        $myorders=Order::where('customer_id',Auth::guard('customer')->id())->get();
        return view('frontend.order.order',[
            'myorders'=>$myorders
        ]);
     }
     function invoice_download($id){
        $order_info=Order::find($id);

        $pdf = PDF::loadView('frontend.invoice.invoiceasha',[
            'order_info'=>$order_info,
        ]);
        return $pdf->download('pdfview.pdf');
     }

}
