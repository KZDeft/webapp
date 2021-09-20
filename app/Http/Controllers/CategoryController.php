<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
session_start();
class CategoryController extends Controller

{
    // Admin Function
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        }
        else {
            return  Redirect::to('admin')->send();
        }
    }
    public function add_category() {
        $this->AuthLogin();
        return view('admin.add_category');
    }
    public function all_category() {
        $this->AuthLogin();
        $all_category = DB::table('tbl_category')->orderBy('updated_at','desc')->paginate(5);
        $manager_category = view('admin.all_category')->with('all_category', $all_category);
        return view('admin_layout')->with('all_category', $manager_category);
    }
    public function save_category(Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['category_name'] = $request->category_name;
        $data['category_status'] = $request->category_status;
        $data['created_at'] = $date->format('Y-m-d H:i:s ');
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_category')->insert($data);
        Session::put('message', 'Added new category');
        return Redirect::to('all-category');
    }
    public function edit_category($category_id) {
        $this->AuthLogin();
        $edit_category = DB::table('tbl_category')->where('category_id', $category_id)->get();
        $manager_category = view('admin.edit_category')->with('edit_category', $edit_category);
        return view('admin_layout')->with('edit_category', $manager_category);
    }
    public function  update_category($category_id, Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['category_name'] = $request->category_name;
        $data['category_status'] = $request->category_status;
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_category')->where('category_id', $category_id)->update($data);
        Session::put('message', 'Updated category');
        return Redirect::to('all-category');
    }
    public function delete_category($category_id) {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_id)->delete();
        Session::put('message', 'Deleted category');
        return Redirect::to('all-category');
    }

    //Index Function

    public function category_home($category_id) {
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        $category_name = DB::table('tbl_category')->where('category_id','=', $category_id)->get();
        $category_product = DB::table('tbl_product')->where('category_id', '=', $category_id)
            ->orderByDesc('product_id')->get();
        return view('pages.category.show_category_home')
            ->with('all_brand',$all_brand)
            ->with('all_category',$all_category)
            ->with('category_product', $category_product)
            ->with('category_name', $category_name);
    }
}
