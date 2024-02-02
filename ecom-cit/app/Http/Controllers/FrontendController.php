<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Order_product;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index(){
        $categories=Category::all();
        $products=Product::all();
        return view('frontend.index',[
            'categories'=>$categories,
            'products'=>$products,
        ]);
    }
    function category_details($id){
        $products=Product::where('category_id',$id)->get();
        return view('frontend.category_details',[
            'products'=>$products
        ]);

    }
    function product_details($slug){
        $products_id=Product::where('slug',$slug)->first()->id;
        $products_details=Product::find($products_id);
        $available_colors=Inventory::where('product_id',$products_id)->groupBy('color_id')->selectRaw('count(*) as total,color_id')->get();
        $available_sizes=Inventory::where('product_id',$products_id)->groupBy('size_id')->selectRaw('count(*) as total,size_id')->get();


        return view('frontend.product_details',[
            'product_details'=>$products_details,
            'available_colors'=>$available_colors,
            'available_sizes'=>$available_sizes
        ]);
    }
    function getsize(Request $request){


        $str='';
        $sizes=Inventory::where('product_id',$request->products_id)->where('color_id',$request->color_id)->get();
        foreach($sizes as $size){
            $str.= '<li ><input id="size'.$size->size_id.'" type="radio" name="size_id" value="'. $size->size_id.'">
            <label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label>
        </li>';
        }
        echo $str;

    }
    function review_store(Request $request){
        Order_product::where('customer_id',Auth::guard('customer')->id())->where('product_id',$request->product_id)->first()->update([
            'star'=>$request->stars,
            'review'=>$request->review,

        ]);
    }
    function shop(Request $request){
        $data=$request->all();

        $products=Product::where(function($q) use ($data){
            $min=1;
            $max=100000;
            if(!empty($data['min'])&&$data['min']!=''&&$data['min']!='undefined'){
                $min=$data['min'];

            }
            if(!empty($data['max'])&&$data['max']!=''&&$data['max']!='undefined'){
                $max=$data['max'];

            }
            if(!empty($data['search_input'])&&$data['search_input']!=''&&$data['search_input']!='undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name','Like','%'.$data['search_input'].'%');

                });

            }
            if(!empty($data['category_id'])&&$data['category_id']!=''&&$data['category_id']!='undefined'){
                $q->where(function($q) use ($data){
                    $q->where('category_id',$data['category_id']);

                });

            }
            if(!empty($data['min'])&&$data['min']!=''&&$data['min']!='undefined'||!empty($data['max'])&&$data['max']!=''&&$data['max']!='undefined'){

                    $q->whereBetween('after_discount',[$min,$max]);



            }


        })->get();












        $categories=Category::all();
        $colors=Color::all();
        $sizes=Size::all();
        return view('frontend.shop',[
            'products'=>$products,
            'categories'=>$categories,
            'colors'=>$colors,
            'sizes'=>$sizes
        ]);
    }
}
