<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend

Route::get('/', [HomeController::class,'index']);
Route::get('/home-page', [HomeController::class, 'index']);
Route::get('/newest-product', [HomeController::class, 'newest']);
Route::post('/search',[HomeController::class, 'search']);
Route::get('/login',[HomeController::class,'login']);
Route::post('/check-login',[HomeController::class,'check_login']);
Route::get('/logout-customer',[HomeController::class,'logout_customer']);
Route::post('/sign-up',[HomeController::class,'sign_up']);



//Backend

Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'logout']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

//Category
Route::get('/add-category',[CategoryController::class, 'add_category']);
Route::get('/all-category',[CategoryController::class, 'all_category']);
Route::get('/edit-category/{category_id}',[CategoryController::class, 'edit_category']);
Route::get('/delete-category/{category_id}',[CategoryController::class, 'delete_category']);
Route::post('/save-category',[CategoryController::class, 'save_category']);
Route::post('/update-category/{category_id}',[CategoryController::class, 'update_category']);
Route::get('/category/{category_id}',[CategoryController::class, 'category_home']);


//Brand
Route::get('/add-brand',[BrandController::class, 'add_brand']);
Route::get('/all-brand',[BrandController::class, 'all_brand']);
Route::get('/edit-brand/{brand_id}',[BrandController::class, 'edit_brand']);
Route::get('/delete-brand/{brand_id}',[BrandController::class, 'delete_brand']);
Route::post('/save-brand',[BrandController::class, 'save_brand']);
Route::post('/update-brand/{brand_id}',[BrandController::class, 'update_brand']);
Route::get('/brand/{brand_id}',[BrandController::class, 'brand_home']);

//Product
Route::get('/add-product',[ProductController::class, 'add_product']);
Route::get('/all-product',[ProductController::class, 'all_product']);
Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);
Route::post('/save-product',[ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}',[ProductController::class, 'update_product']);
Route::get('/import-product/{product_id}',[ProductController::class, 'import_product']);
Route::post('/save-import-product/{product_id}',[ProductController::class, 'save_import_product']);
Route::get('/product-detail/{product_id}',[ProductController::class, 'product_detail']);

//Sales
Route::get('/add-sale',[SaleController::class, 'add_sale']);
Route::get('/all-sale',[SaleController::class, 'all_sale']);
Route::get('/edit-sale/{sale_id}',[SaleController::class, 'edit_sale']);
Route::get('/delete-sale/{sale_id}',[SaleController::class, 'delete_sale']);
Route::post('/save-sale',[SaleController::class, 'save_sale']);
Route::post('/update-sale/{sale_id}',[SaleController::class, 'update_sale']);


//Cart
Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
Route::get('/cart',[CartController::class, 'show_cart']);
Route::get('/del-product/{session_id}',[CartController::class, 'del_product']);
Route::post('/update-cart',[CartController::class, 'update_cart']);
Route::post('/check-coupon',[CartController::class, 'check_coupon']);
Route::get('/del-all-product',[CartController::class, 'del_all_product']);

//Checkout
Route::post('/checkout',[CheckoutController::class, 'checkout']);
Route::get('/checkout-success',[CheckoutController::class, 'checkout_success']);
Route::get('/checkout-online-success',[CheckoutController::class, 'checkout_online_success']);
Route::get('/checkout-online',[CheckoutController::class, 'checkout_online']);
Route::post('/save-order',[CheckoutController::class, 'save_order']);

//Order
Route::get('/all-order',[OrderController::class, 'all_order']);
Route::get('/unapproved-order',[OrderController::class, 'unapproved_order']);
Route::get('/approved-order',[OrderController::class, 'approved_order']);
Route::get('/completed-order',[OrderController::class, 'completed_order']);
Route::get('/canceled-order',[OrderController::class, 'canceled_order']);
Route::get('/my-order/{admin_id}',[OrderController::class, 'my_order']);
Route::get('/view-order/{order_id}',[OrderController::class, 'view_order']);
Route::get('/approve-order/{order_id}',[OrderController::class, 'approve_order']);
Route::post('/save-approve-order/',[OrderController::class, 'save_approve_order']);
Route::get('/complete-order/{order_id}',[OrderController::class, 'complete_order']);
Route::get('/order_history',[OrderController::class, 'order_history']);

//Dashboard
Route::post('/days-order',[DashboardController::class, 'days_order']);

Route::post('/filter-by-date',[DashboardController::class, 'filter_by_date']);

Route::post('/dashboard-filter',[DashboardController::class, 'dashboard_filter']);
