<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DateTime;

class SaleController extends Controller
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
        public function add_sale() {
            $all_promotion_type = DB::table('tbl_promotion_type')->get();
            $this->AuthLogin();
            return view('admin.add_sale')->with('all_promotion_type', $all_promotion_type);
        }
        public function all_sale() {
            $this->AuthLogin();
            $all_sale = DB::table('tbl_promotion')
                ->join('tbl_employee','tbl_promotion.employee_id','=','tbl_employee.employee_id')
                ->join('tbl_promotion_type','tbl_promotion.promotion_type_id','=','tbl_promotion_type.promotion_type_id')
                ->select('tbl_promotion.*', 'tbl_employee.employee_name', 'tbl_promotion_type.promotion_type_desc')
                ->paginate(5);
            $manager_sale = view('admin.all_sale')->with('all_sale', $all_sale);
            return view('admin_layout')->with('all_sale', $manager_sale);
        }
        public function save_sale(Request $request) {
            $this->AuthLogin();
            $data = array();
            $date = new DateTime('now');
            $employee_id  = Session::get('admin_id');
            $data['employee_id'] = $employee_id;
            $data['promotion_desc'] = $request->sale_desc;
            $data['promotion_type_id'] = $request->sale_type;
            $data['promotion_coupon'] = $request->sale_coupon;
            $data['promotion_value'] = $request->sale_value;
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
            $data['created_at'] = $date->format('Y-m-d H:i:s ');
            $data['updated_at'] = $date->format('Y-m-d H:i:s');
            DB::table('tbl_sale')->insert($data);
            Session::put('message', 'Added new promotion');
            return Redirect::to('all-sale');
        }
        public function edit_sale($category_id) {
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
        public function delete_sale($sale_id) {
            $this->AuthLogin();
            DB::table('tbl_sale')->where('sale_id', $sale_id)->delete();
            Session::put('message', 'Deleted sale');
            return Redirect::to('all-sale');
        }
}
