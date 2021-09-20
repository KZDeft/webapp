<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
session_start();

class BrandController extends Controller
{
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        }
        else {
            return  Redirect::to('admin')->send();
        }
    }
    public function add_brand() {
        $this->AuthLogin();
        return view('admin.add_brand');
    }
    public function all_brand() {
        $this->AuthLogin();
        $all_brand = DB::table('tbl_brand')->orderBy('updated_at','desc')->paginate(5);
        $manager_brand = view('admin.all_brand')->with('all_brand', $all_brand);
        return view('admin_layout')->with('all_brand', $manager_brand);
    }
    public function save_brand(Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['brand_name'] = $request->brand_name;
        $data['brand_status'] = $request->brand_status;
        $data['brand_desc'] = $request->brand_desc;
        $data['created_at'] = $date->format('Y-m-d H:i:s ');
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Added new brand');
        return Redirect::to('all-brand');
    }
    public function edit_brand($brand_id) {
        $this->AuthLogin();
        $edit_brand = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();
        $manager_brand = view('admin.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('edit_brand', $manager_brand);
    }
    public function  update_brand($brand_id, Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);
        Session::put('message', 'Updated brand');
        return Redirect::to('all-brand');
    }
    public function delete_brand($brand_id) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Deleted brand');
        return Redirect::to('all-brand');
    }

    //Index Function
    public function brand_home($brand_id) {
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        $brand_name = DB::table('tbl_brand')->where('brand_id','=', $brand_id)->get();
        $brand_product = DB::table('tbl_product')->where('brand_id', '=', $brand_id)
            ->orderByDesc('product_id')->get();
        return view('pages.brand.show_brand_home')
            ->with('all_brand',$all_brand)
            ->with('all_category',$all_category)
            ->with('brand_product', $brand_product)
            ->with('brand_name', $brand_name);
    }
}
