<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
session_start();

class HomeController extends Controller
{
    public function index() {
        $all_product = DB::table('tbl_product')->where('product_status', '=', '1')->paginate(6);
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        return view('pages.home')->with('all_category', $all_category)->with('all_brand', $all_brand)
            ->with('all_product', $all_product);
    }

    public function newest() {
        $all_product = DB::table('tbl_product')->where('product_status', '=', '1')->orderByDesc('product_id')->limit(10)->paginate(6);
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        return view('pages.product.newest_product')->with('all_category', $all_category)->with('all_brand', $all_brand)
            ->with('all_product', $all_product);
    }

    public function search( Request $request) {
        $keywords = $request->keywords;
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keywords.'%')
            ->where('product_status', '=', '1')->orderByDesc('product_id')->get();
        return view('pages.product.search_product')->with('all_category', $all_category)->with('all_brand', $all_brand)
            ->with('search_product', $search_product);
    }

    public function login() {
        return view('login');
    }

    public  function check_login(Request $request) {
        $username = $request->username;
        $password = md5($request->password);
        if(DB::table('tbl_user')->where('username', $username)->where('password', $password)->where('role_id', '=', '3')->exists()) {
            $result = DB::table('tbl_customer')->where('username',$username)->first();
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/home-page');
        }
        else {
            Session::put('message', 'Username or password is wrong!!!');
            return Redirect::to('/login');
        }
    }
    public function logout_customer() {

        Session::put('customer_id', null);
        return Redirect::to('/home-page');
    }
    public function sign_up(Request $request) {
        $data = $request->all();
        $date = new DateTime('now');
        $data_customer = array();
        $data_customer['username'] = $request->username;
        $data_customer['customer_name'] = $request->customer_name;
        $data_customer['customer_gender'] = $request->customer_gender;
        $data_customer['customer_address'] = $request->customer_address;
        $data_customer['customer_phone'] = $request->customer_phone;
        $data_customer['customer_email'] = $request->customer_email;
        $data_customer['created_at'] = $date->format('Y-m-d H:i:s ');
        $data_customer['updated_at'] = $date->format('Y-m-d H:i:s ');
        DB::table('tbl_customer')->insert($data_customer);
        $data_user = array();
        $data_user['username'] = $request->username;
        $data_user['password'] = md5($request->password);
        $data_user['role_id'] = $request->role_id;
        $data_user['created_at'] = $date->format('Y-m-d H:i:s ');
        $data_user['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_user')->insert($data_user);
        Session::put('message', 'Success!!!');
        return Redirect::to('/login');
    }

}
