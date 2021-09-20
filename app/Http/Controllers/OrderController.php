<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
session_start();

class OrderController extends Controller
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
    public function all_order() {
        $all_order = DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
//            ->join('tbl_shipping_partner','tbl_order.shipping_partner_id','=','tbl_shipping_partner.shipping_partner_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
            ->orderBy('updated_at','desc')->paginate(5);
        foreach ($all_order as $key => $order) {
            if($order->employee_id) {
                $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
            }
            else {
                $order->employee_name = 'Unapproved';
            }
            if($order->shipping_employee_id) {
                $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
            }
            else {
                $order->shipping_employee_name = 'Unapproved';
            };
        }

        $manager_order = view('admin.all_order')->with('all_order', $all_order);
        return view('admin_layout')->with('all_order', $manager_order);
    }
     public function unapproved_order() {
         $all_order = DB::table('tbl_order')->where('order_status', '=', 0)
             ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
             ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
             ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
             ->orderBy('updated_at','desc')->paginate(5);
         foreach ($all_order as $key => $order) {
             if($order->employee_id) {
                 $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
             }
             else {
                 $order->employee_name = 'Unapproved';
             }
             if($order->shipping_employee_id) {
                 $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
             }
             else {
                 $order->shipping_employee_name = 'Unapproved';
             };
         }


         $manager_order = view('admin.all_unapproved_order')->with('all_order', $all_order);
         return view('admin_layout')->with('all_order', $manager_order);
     }

    public function approved_order() {
        $all_order = DB::table('tbl_order')->where('order_status', '=', 1)
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
            ->orderBy('updated_at','desc')->paginate(5);
        foreach ($all_order as $key => $order) {
            if($order->employee_id) {
                $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
            }
            else {
                $order->employee_name = 'Unapproved';
            }
            if($order->shipping_employee_id) {
                $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
            }
            else {
                $order->shipping_employee_name = 'Unapproved';
            };
        }


        $manager_order = view('admin.all_approved_order')->with('all_order', $all_order);
        return view('admin_layout')->with('all_order', $manager_order);
    }
    public function completed_order() {
        $all_order = DB::table('tbl_order')->where('order_status', '=', 2)
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
            ->orderBy('updated_at','desc')->paginate(5);
        foreach ($all_order as $key => $order) {
            if($order->employee_id) {
                $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
            }
            else {
                $order->employee_name = 'Unapproved';
            }
            if($order->shipping_employee_id) {
                $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
            }
            else {
                $order->shipping_employee_name = 'Unapproved';
            };
        }


        $manager_order = view('admin.all_completed_order')->with('all_order', $all_order);
        return view('admin_layout')->with('all_order', $manager_order);
    }
    public function my_order($admin_id) {
        $all_order = DB::table('tbl_order')->where('shipping_employee_id', $admin_id)
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
            ->orderBy('updated_at','desc')->paginate(5);
        foreach ($all_order as $key => $order) {
            if($order->employee_id) {
                $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
            }
            else {
                $order->employee_name = 'Unapproved';
            }
            if($order->shipping_employee_id) {
                $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
            }
            else {
                $order->shipping_employee_name = 'Unapproved';
            };
        }


        $manager_order = view('admin.all_my_order')->with('all_order', $all_order);
        return view('admin_layout')->with('all_order', $manager_order);
    }

    public function canceled_order() {
        $all_order = DB::table('tbl_order')->where('order_status', '=', 3)
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_bill','tbl_order.order_id','=','tbl_bill.order_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name','tbl_bill.bill_total')
            ->orderBy('updated_at','desc')->paginate(5);
        foreach ($all_order as $key => $order) {
            if($order->employee_id) {
                $order->employee_name= DB::table('tbl_employee')->where('employee_id', $order->employee_id)->first()->employee_name;
            }
            else {
                $order->employee_name = 'Unapproved';
            }
            if($order->shipping_employee_id) {
                $order->shipping_employee_name= DB::table('tbl_employee')->where('employee_id', $order->shipping_employee_id)->first()->employee_name;
            }
            else {
                $order->shipping_employee_name = 'Unapproved';
            };
        }


        $manager_order = view('admin.all_canceled_order')->with('all_order', $all_order);
        return view('admin_layout')->with('all_order', $manager_order);
    }

    public function view_order($order_id) {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')->where('order_id', $order_id)->get();
        $customer_by_id = DB::table('tbl_customer')->where('customer_id', '=', $order_by_id['0']->customer_id)->get();
        $detail_by_id = DB::table('tbl_order_detail')->where('order_id', $order_id)->get();
        foreach ($detail_by_id as $key => $value) {
            $product_name = DB::table('tbl_product')->where('product_id',$value->product_id)->first('product_name');
            $product_image = DB::table('tbl_product')->where('product_id',$value->product_id)->first('product_image');
            $value->product_name = $product_name->product_name;
            $value->product_image = $product_image->product_image;
        }
        $bill_by_id = DB::table('tbl_bill')->where('order_id', $order_id)->get();
        $manager_order_by_id  = view('admin.view_order')
            ->with('order_by_id', $order_by_id)
            ->with('detail_by_id', $detail_by_id)
            ->with('bill_by_id', $bill_by_id)
            ->with('customer_by_id', $customer_by_id);
//        dd($manager_order_by_id);
        return view('admin_layout')->with('order', $manager_order_by_id);
    }
    public function approve_order($order_id) {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')->where('order_id', $order_id)->get();
        $all_shipping_employee = DB::table('tbl_employee')
            ->join('tbl_user', 'tbl_user.username', '=', 'tbl_employee.username')
            ->select('tbl_employee.*', 'tbl_user.role_id')
            ->get();
        $manager_order_by_id  = view('admin.approve_order')
            ->with('order_by_id', $order_by_id)
            ->with('all_shipping_employee', $all_shipping_employee);

        return view('admin_layout')->with('order', $manager_order_by_id);
    }
    public function save_approve_order(Request $request) {
        $this->AuthLogin();
        $data = array();
        $date = new DateTime('now');
        $data['order_status'] = 1;
        $data['employee_id'] = Session::get('admin_id');
        $data['shipping_employee_id'] = $request->employee_id;
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_order')->where('order_id', $request->order_id)->update($data);
        Session::put('message', 'Approved Order');
        return Redirect::to('all-order');
    }
    public function complete_order($order_id) {
        $data = array();
        $date = new DateTime('now');
        $data['order_status'] = 2;
        $data['updated_at'] = $date->format('Y-m-d H:i:s');
        DB::table('tbl_order')->where('order_id',$order_id)->update($data);
        Session::put('message', 'Completed Order');
        return Redirect::to('all-order');
    }

    public function order_history() {

    }
}
