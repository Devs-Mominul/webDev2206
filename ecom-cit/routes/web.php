<?php

use App\Http\Controllers\AshaController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Rolemanager;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/sss', function () {
    return view('welcome');
});

Route::get('/dashboard',[HomeController::class,'dashboard']

)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/image/update',[HomeController::class,'profile_image'])->name('profile.image');
//user list
Route::get('/user/list',[UserController::class,'user_list'])->name('user.list');
Route::get('/user/delete/{id}',[UserController::class,'user_delete'])->name('user.delete');
//category
Route::get('/category',[CategoryController::class,'category_view'])->name('category');
Route::post('/category/store',[CategoryController::class,'category_store'])->name('category.store');
//subcategory
Route::get('/subcategory',[SubcategoryController::class,'subcategory'])->name('subcategory');
Route::post('/subcategory/store',[SubcategoryController::class,'subcategory_store'])->name('subcategory.store');
//brand
Route::get('/brand',[BrandController::class,'brand'])->name('brand');
Route::post('/brand',[BrandController::class,'brand_store'])->name('brand.store');
//product
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::post('/getsubcategory',[ProductController::class,'getsubcategory']);
Route::post('/changeStatus',[ProductController::class,'changeStatus']);
Route::post('/product_store',[ProductController::class,'product_store'])->name('product.store');
Route::get('/product/list',[ProductController::class,'product_list'])->name('product.list');
//Inventorycontroller
Route::get('/variation',[InventoryController::class,'variation'])->name('variation');
Route::post('/color/store',[InventoryController::class,'color'])->name('color.store');
Route::post('/size/store',[InventoryController::class,'size'])->name('size.store');
Route::get('/Inventory/{id}',[InventoryController::class,'inventory'])->name('inventory');
Route::post('/Inventory/{id}',[InventoryController::class,'inventory_store'])->name('inventory.store');
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/category_details/{id}',[FrontendController::class,'category_details'])->name('category_details');
Route::get('/product/details/{slug}',[FrontendController::class,'product_details'])->name('product.details');
Route::post('/getsize',[FrontendController::class,'getsize']);
Route::get('/customer/register',[CustomerAuthController::class,'customer_register'])->name('customer.register');
Route::get('/customer/login',[CustomerAuthController::class,'customer_login'])->name('customer.login');
Route::post('/customer/register/store',[CustomerAuthController::class,'customer_register_store'])->name('customer.register.store');
Route::post('/customer/login/store',[CustomerAuthController::class,'customer_login_store'])->name('customer.login.store');
Route::get('/customer/profile',[CustomerAuthController::class,'customer_profile'])->name('customer.profile')->middleware('customer');
Route::get('/customer/logout',[CustomerAuthController::class,'customer_logout'])->name('customer.logout');
Route::post('/customer/update',[CustomerAuthController::class,'customer_update'])->name('customer.update');
Route::post('/cart/stores',[CartController::class,'cart_store'])->name('cart.store');
Route::get('/cart/carts',[CartController::class,'carts'])->name('carts');
Route::post('/cart/update',[CartController::class,'cart_update'])->name('cart.update');
Route::get('/cart/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/cart/store',[CouponController::class,'coupon_store'])->name('coupon.store');
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/order/store',[CheckoutController::class,'order_store'])->name('order.store');
Route::get('/order/success',[CheckoutController::class,'order_success'])->name('product.order.success');
Route::get('/customer/order/single',[CustomerAuthController::class,'order'])->name('myorders');
Route::get('/invoice/download/{id}',[CustomerAuthController::class,'invoice_download'])->name('invoice.download');
Route::get('/backend/order',[OrderController::class,'order'])->name('backend.order');
Route::post('/backend/order/active',[OrderController::class,'order_active'])->name('order.active');
// SSLCOMMERZ Start

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
Route::post('/review/store',[FrontendController::class,'review_store'])->name('review.store');
Route::get('/role/manage',[Rolemanager::class,'role_manager'])->name('role.manager');
Route::post('/permission/manage/post',[Rolemanager::class,'role_post'])->name('permission.store');
Route::post('/role/manage/post',[Rolemanager::class,'role_manager_post'])->name('role.manager.post');
Route::post('/assign/role',[Rolemanager::class,'assign_role'])->name('assign.role');
Route::get('/assign/user/remove/{id}',[Rolemanager::class,'user_assign_remove'])->name('user.assign.remove');
Route::get('/shop',[FrontendController::class,'shop'])->name('shop');
Route::resource('ashamominul',AshaController::class);
Route::get('/reload-captcha', [CustomerAuthController::class, 'reloadCaptcha']);


require __DIR__.'/auth.php';
