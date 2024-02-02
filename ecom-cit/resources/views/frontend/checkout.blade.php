@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li>Checkout</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- wpo-checkout-area start-->
<div class="wpo-checkout-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-page-title">
                    <h2>Your Checkout</h2>
                    <p>There are 4 products in this list</p>
                </div>
            </div>
        </div>
        <form action="{{ route('order.store') }}" method="POST" >
            @csrf
            <div class="checkout-wrap">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="caupon-wrap s3">
                            <div class="biling-item">
                                <div class="coupon coupon-3">
                                    <h2>Billing Address</h2>
                                </div>
                                <div class="billing-adress">
                                    <div class="contact-form form-style">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="First Name*" id="fname1"
                                                    name="fname" value="{{ Auth::guard('customer')->user()->fname }}">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Last Name*" id="fname2"
                                                    name="lname" value="{{ Auth::guard('customer')->user()->lname }}" >
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <select name="country" id="City" class="form-control">

                                                    @foreach (App\Models\Country::all() as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <select name="city" id="city_ids" class="form-control citys">
                                                    <option value="">Select City</option>



                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Postcode / ZIP*" id="Post2"
                                                    name="zip">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Company Name*" id="Company"
                                                    name="company">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="email" placeholder="Email Address*" id="email4"
                                                    name="email">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Phone*" id="email2"
                                                    name="phone">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <input type="text" placeholder="Address*" id="Adress"
                                                    name="address">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="note-area">
                                                    <textarea name="message"
                                                        placeholder="Additional Information"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="biling-item-3">
                                    <input id="toggle4" name="ship_check" type="checkbox" value="1">
                                    <label class="fontsize" for="toggle4">Ship to a Different Address?</label>
                                    <div class="billing-adress" id="open4">
                                        <div class="contact-form form-style">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="First Name*" id="fname6"
                                                        name="ship_fname">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Last Name*" id="fname7"
                                                        name="ship_lname">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <select name="ship_country" id="Country" class="form-control">

                                                        @foreach (App\Models\Country::all() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>

                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <select name="ship_city" id="Country" class="form-control city">
                                                        <option value="">Select City</option>



                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Postcode / ZIP*" id="Post1"
                                                        name="ship_zip">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Company Name*" id="Company1"
                                                        name="ship_company">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="email" placeholder="Email Address*" id="email5"
                                                        name="ship_email">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Phone*" id="phone1"
                                                        name="ship_phone">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="text" placeholder="Address*" id="Adress1"
                                                        name="ship_address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="cout-order-area">
                            <h3>Your Order</h3>
                            <div class="oreder-item">
                                <div class="title">
                                    <h2>Products <span>Subtotal</span></h2>
                                </div>
                                @foreach ($carts as $cart)
                                <div class="oreder-product">
                                    <div class="images">
                                        <span>
                                            <img src="{{ asset('upload/preview/') }}/{{ $cart->rel_to_product->preview }}" alt="">
                                        </span>
                                    </div>
                                    <div class="product">
                                        <ul>
                                            <li class="first-cart">{{ $cart->rel_to_product->product_name }}({{ $cart->count() }})</li>
                                            <li>
                                                <div class="rating-product">
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <span>15</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <span>${{ $cart->rel_to_product->after_discount }}</span>
                                </div>

                                @endforeach


                                <!-- Shipping -->
                                <div class="title s2">
                                  <h2>Discount: <span id='grand'>  {{ session('discount') }}</span></h2>
                                </div>
                                <div class="mt-3 mb-3">
                                    <div class="border-0 title">
                                        <h2>Delivery Charge</h2>
                                    </div>
                                    <ul>
                                        <li class="free">
                                            <input id="Free" type="radio" data-total="{{ session('total') }}" class="charge" name="charge" value="70" checked>
                                            <label for="Free">Inside City: <span>$70</span></label>
                                        </li>
                                        <li class="free">
                                            <input id="Local" type="radio" name="charge" name="color" class="charge" data-total="{{ session('total') }}" value="100">
                                            <label for="Local">Outside City: <span>$100</span></label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="title s2">
                                    <h2>Total<span>${{ session('total') }}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="caupon-wrap s5">
                            <div class="payment-area">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="payment-option" id="open5">
                                            <h3>Payment</h3>
                                            <div class="payment-select">
                                                <ul>
                                                    <li class="">
                                                        <input id="remove" type="radio" name="payment"
                                                            value="1">
                                                        <label for="remove">Cash on Delivery</label>
                                                    </li>
                                                    <li class="">
                                                        <input id="add" type="radio" name="payment" checked="checked" value="2">
                                                        <label for="add">Pay With SSLCOMMERZ</label>
                                                    </li>
                                                    <li class="">
                                                        <input id="getway" type="radio" name="payment"
                                                            value="3">
                                                        <label for="getway">Pay With STRIPE</label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="discount" value="{{ session('discount') }}">
                                            <input type="hidden" name="sub_total" value="{{ session('sub') }}">
                                            <input type="hidden" name="total" value="{{ session('total') }}">
                                            <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->id() }}">
                                            <div id="open6" class="payment-name active">
                                                <div class="contact-form form-style">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-12">
                                                            <div class="text-center submit-btn-area">
                                                                <button class="theme-btn" type="submit">Place
                                                                    Order</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- wpo-checkout-area end-->

@endsection

@push('frontend_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endpush
@push('frontend_js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Country').select2();
    });
</script>


@endpush
@push('frontend_js')
<script>
    $('.charge').click(function(){
        var charge=$(this).val();
        var total=$(this).attr('data-total');
        var grandtotal=parseInt(charge)+parseInt(total);
        $('#grand').html(grandtotal);
    })
</script>

@endpush


@push('frontend_js')
<script>
    $('#Country').change(function(){
        var country_id=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/getCity',
            data:{'country_id':country_id},
            success:function(data){
               $('.city').html(data);
            }
        })
    });
    $('#City').change(function(){
        var country_id=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/getCity',
            data:{'country_id':country_id},
            success:function(data){
               $('.citys').html(data);
            }
        })
    })

</script>

@endpush
