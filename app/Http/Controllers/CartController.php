<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Cart;
session_start();

class CartController extends Controller
{
    public function add_cart_ajax(Request $request) {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');

        if ($cart) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_quantity' => $data['cart_product_quantity'],
                        'product_qty' => $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                    Session::put('cart', $cart);
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
             Session::put('cart', $cart);
        }
        Session::put('cart', $cart);

        Session::save();
    }

    public function show_cart() {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d');
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        $all_promotion = DB::table('tbl_promotion')->where([['start_date', '<=', $date],
            ['end_date', '>=', $date]])->get();
        return view('pages.cart.show_cart')->with('all_category', $all_category)->with('all_brand', $all_brand)
            ->with('all_promotion',$all_promotion);
    }

    public function del_product($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            if ($cart == []) {
                Session::put('promotion_type','0');
                Session::put('promotion_value','0');
                return Redirect::back();
            }
            return Redirect::back();
        } else {

            Session::put('promotion_type','0');
            Session::put('promotion_value','0');
            return Redirect::back();
        }
    }

    public function update_cart(Request $request) {
        $cart = Session::get('cart');
        $data = $request->all();

        foreach ($cart as $key => $value) {
            foreach ($data['cart_qty'] as $key1 => $value1) {
                if($cart[$key]['session_id'] == $key1){
                    $cart[$key]['product_qty'] = $value1;
                }

            }
        }
        Session::put('cart', $cart);
        return Redirect::back();
    }
    public function del_all_product() {
        $cart = [];
        Session::put('cart', $cart);
        Session::put('promotion_type','0');
        Session::put('promotion_value','0');
        return Redirect::back();
    }

    public function check_coupon(Request $request) {
        $data = $request->all();
        $date = new DateTime('now');
        $date = $date->format('Y-m-d');

        $promotion = DB::table('tbl_promotion')->where('promotion_coupon', $data['coupon_code'])->first();
        if($promotion) {
            if($promotion->start_date <= $date && $promotion->end_date >= $date) {
                Session::put('promotion_type',$promotion->promotion_type_id);
                Session::put('promotion_value',$promotion->promotion_value);
                Session::put('message_coupon','Coupon applied!!!');
                return Redirect::back();
            }
            else if ($promotion->start_date < $date) {
                Session::put('message_coupon','Coupon is not valid yet!!!');
                Session::put('promotion_type','0');
                Session::put('promotion_value','0');
                return Redirect::back();
            }
            else if ($promotion->end_date < $date) {
                Session::put('message_coupon','Coupon expired!!!');
                Session::put('promotion_type','0');
                Session::put('promotion_value','0');
                return Redirect::back();
            }

        }
        else {
            Session::put('message_coupon','Coupon does not exist!!!');
            Session::put('promotion_type','0');
            Session::put('promotion_value','0');
            return Redirect::back();
        }
    }
}
