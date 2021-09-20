<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;

session_start();

class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        $cart_amount = $request->all();
        $cart = Session::get('cart');
//        dd($cart);
        Session::put('cart_amount',$cart_amount);
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)
            ->get(['customer_name','customer_address', 'customer_phone', 'customer_email']);
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        $all_payment_method = DB::table('tbl_payment_method')->get();
//        $user = DB::table('tbl_user')->orderByDesc('user_id')->first();
//        dd($user);
        return view('pages.checkout.show_checkout')
            ->with('all_category', $all_category)
            ->with('all_brand', $all_brand)
            ->with('customer', $customer)
            ->with('all_payment_method', $all_payment_method);
    }
    public function save_order(Request $request) {
        $cart = Session::get('cart');
        $date = new DateTime('now');
        $customer_id = Session::get('customer_id');
        $order_data = array();
        $order_data['customer_id'] = $customer_id;
        $order_data['payment_method_id'] = $request->payment_method;
        $order_data['order_shipping_name'] = $request->order_shipping_name;
        $order_data['order_shipping_address'] = $request->order_shipping_address;
        $order_data['order_shipping_phone'] = $request->order_shipping_phone;
        $order_data['order_shipping_email'] = $request->order_shipping_email;
        $order_data['created_at'] = $date->format('Y-m-d H:i:s ');
        $order_data['updated_at'] = $date->format('Y-m-d H:i:s');
        $order_data['order_status'] = 0;
        DB::table('tbl_order')->insert($order_data);
        $order_id = DB::table('tbl_order')->orderByDesc('order_id')->first('order_id');
        foreach ($cart as $key => $value) {
            $order_detail = array();
            $order_detail['order_id'] = $order_id->order_id;
            $order_detail['product_id'] = $value['product_id'];
            $order_detail['product_quantity'] = $value['product_qty'];
            $order_detail['product_price'] = $value['product_price'];
            $order_detail['product_total'] = $value['product_price'] * $value['product_qty'];
            $order_detail['created_at'] = $date->format('Y-m-d H:i:s ');
            $order_detail['updated_at'] = $date->format('Y-m-d H:i:s');
            $new_quantity = $value['product_quantity'] - $value['product_qty'];
            $data_product = array();
            $data_product['product_quantity'] = $new_quantity;
            $data_product['updated_at'] = $date->format('Y-m-d H:i:s');
            DB::table('tbl_product')->where('product_id', $value['product_id'])->update($data_product);
            DB::table('tbl_order_detail')->insert($order_detail);
        }
        $cart_amount = Session::get('cart_amount');
        $bill = array();
        $bill['order_id'] = $order_id->order_id;
        $bill['bill_subtotal'] = $cart_amount['cart_subtotal'];
        $bill['bill_discount'] = $cart_amount['cart_discount'];
        $bill['bill_total'] = $cart_amount['cart_total'];
        $bill['created_at'] = $date->format('Y-m-d');
        $bill['updated_at'] = $date->format('Y-m-d');
        DB::table('tbl_bill')->insert($bill);

        Session::forget('cart');

        if($request->payment_method == 1) {
            Session::forget('cart_amount');
            Session::forget('promotion_type');
            Session::forget('promotion_value');
            return Redirect::to('checkout-success');
        }
        else {
            return Redirect::to('checkout-online');
        }
    }
    public function checkout_online() {
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        return view('pages.checkout.checkout_online')
            ->with('all_category', $all_category)
            ->with('all_brand', $all_brand);
    }

    public function checkout_success() {
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        return view('pages.checkout.checkout_success')
            ->with('all_category', $all_category)
            ->with('all_brand', $all_brand);
    }
    public function checkout_online_success() {
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        Session::forget('cart_amount');
        Session::forget('promotion_type');
        Session::forget('promotion_value');
        return view('pages.checkout.checkout_success')
            ->with('all_category', $all_category)
            ->with('all_brand', $all_brand);
    }
}
