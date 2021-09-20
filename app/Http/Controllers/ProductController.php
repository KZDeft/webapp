<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
session_start();

class ProductController extends Controller
{
    //Admin function
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        }
        else {
            return  Redirect::to('admin')->send();
        }
    }
    public function add_product() {
        $this->AuthLogin();
        $all_brand = DB::table('tbl_brand')->where('brand_status', '=','1')->get();
        $all_category = DB::table('tbl_category')->where('category_status', '=','1')->get();
        return view('admin.add_product')->with('all_brand', $all_brand)->with('all_category',$all_category);
    }
    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->select('tbl_product.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
            ->orderBy('updated_at','desc')->paginate(5);
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('all_product', $manager_product);
    }
    public function save_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = '1';
        $data['product_status'] = $request->product_status;
        $data['product_desc'] = $request->product_desc;
        $data['created_at'] = $date->format('Y-m-d H:i:s ');
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        $get_image = $request->file('product_image');
        if($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'-'.rand(0,1000).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('./uploads/products',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Added new product');
            return Redirect::to('all-product');
        }
        else {
            Session::put('message', 'Image file does not exist');
            return Redirect::to('admin.add-product');
        }


    }
    public function edit_product($product_id) {
        $this->AuthLogin();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $all_brand = DB::table('tbl_brand')->get();
        $all_category = DB::table('tbl_category')->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('all_brand',$all_brand)->with('all_category',$all_category);
        return view('admin_layout')->with('edit_product', $manager_product);
    }
    public function  update_product($product_id, Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['product_desc'] = $request->product_desc;
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        $get_edit_image = $request->file('product_image');
        if($get_edit_image) {
            $get_edit_name_image=$get_edit_image->getClientOriginalName();
            $edit_name_image = current(explode('.',$get_edit_name_image));
            $new_edit_image = $edit_name_image.'-'.rand(0,1000).'.'.$get_edit_image->getClientOriginalExtension();
            $get_edit_image->move('public/uploads/products',$new_edit_image);
            $data['product_image'] = $new_edit_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Updated product');
            return Redirect::to('all-product');
        }
        else {
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Updated product');
            return Redirect::to('all-product');
        }
    }
    public function delete_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Deleted product');
        return Redirect::to('all-product');
    }
    public function import_product($product_id) {
        $this->AuthLogin();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)
            ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
                ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->select('tbl_product.*', 'tbl_category.category_name', 'tbl_brand.brand_name')->get();
        $manager_product = view('admin.import_product')->with('edit_product', $edit_product);
        return view('admin_layout')->with('import_product', $manager_product);
    }
    public function save_import_product($product_id, Request $request) {
        $this->AuthLogin();
        $data = array();
        $data_detail = array();
        $data_product = array();
        $date = new DateTime('now');
        $data['employee_id'] = Session::get('admin_id');

        $data_detail['product_id'] = $product_id;
        $data_detail['product_quantity'] = $request->product_quantity;
        $data['created_at'] = $date->format('Y-m-d H:i:s ');
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        $old_quantity = DB::table('tbl_product')->where('product_id',$product_id)->value('product_quantity');
        $new_quantity = $request->product_quantity + $old_quantity;
        $data_product['product_quantity'] = $new_quantity;
        $data_product['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_import')->insert($data);
        DB::table('tbl_product')->where('product_id', $product_id)->update($data_product);
        $import_id = DB::table('tbl_import')->orderByDesc('import_id')->first('import_id');
        $data_detail['import_id'] = $import_id->import_id;
        DB::table('tbl_import_detail')->insert($data_detail);
        Session::put('message', 'Imported Product');
        return Redirect::to('all-product');
    }


    //index function

    public function product_detail($product_id) {
        $all_brand = DB::table('tbl_brand')->get();
        $all_category = DB::table('tbl_category')->get();
        $product_detail =  DB::table('tbl_product')
            ->where('product_id', '=', $product_id)
            ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->select('tbl_product.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
            ->get();
        foreach ($product_detail as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product =  DB::table('tbl_product')
            ->where('category_id', '=', $category_id)
            ->whereNotIn('product_id', [$product_id])
            ->get();
        return view('pages.product.show_product_detail')
            ->with('all_brand', $all_brand)
            ->with('all_category', $all_category)
            ->with('product_detail', $product_detail)
            ->with('related_product', $related_product);
    }

}
