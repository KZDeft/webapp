<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use  Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function index() {
        return view('admin_login');
    }
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        }
        else {
            return  Redirect::to('admin')->send();
        }
    }

    public function  show_dashboard() {
        $this->AuthLogin();

        $order_0 = DB::table('tbl_order')->where('order_status', '=', '0')->count();
        $order_1 = DB::table('tbl_order')->where('order_status', '=', '1')->count();
        $order_2 = DB::table('tbl_order')->where('order_status', '=', '2')->count();
        $order_3 = DB::table('tbl_order')->where('order_status', '=', '3')->count();




        return view('admin.dashboard')->with(compact('order_0', 'order_1', 'order_2', 'order_3'));
    }

    public  function  dashboard(Request $request) {
        $admin_username = $request->admin_username;
        $admin_password = md5($request->admin_password);

        if(DB::table('tbl_user')->where('username', $admin_username)->where('password', $admin_password)->where('role_id','<', '3')->exists()) {
            $result = DB::table('tbl_employee')->where('username',$admin_username)->first();
            $admin_role = DB::table('tbl_user')->where('username', $admin_username)->first();
            Session::put('admin_name', $result->employee_name);
            Session::put('admin_role', $admin_role->role_id);
            Session::put('admin_id', $result->employee_id);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message', 'Username or password is wrong!!!');
            return Redirect::to('/admin');
        }
    }
    public function logout() {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
