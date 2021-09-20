<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function days_order() {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = DB::table('tbl_bill')->whereBetween('created_at',[$sub30days,$now])
            ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->created_at,
                'sales' => round($val->bill_total,2),
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function filter_by_date(Request $request)
    {

        $this->AuthLogin();
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = DB::table('tbl_bill')->whereBetween('created_at',[$from_date,$to_date])
            ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->get()->toArray();

        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->created_at,
                'sales' => round($val->bill_total),
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request)
    {

        $data = $request->all();


        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();



        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();


        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {

            $get = DB::table('tbl_bill')->whereBetween('created_at',[$sub7days,$now])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = DB::table('tbl_bill')->whereBetween('created_at',[$dau_thangtruoc,$cuoi_thangtruoc])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'thangnay') {

            $get = DB::table('tbl_bill')->whereBetween('created_at',[$dauthangnay,$now])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'homnay') {

            $get = DB::table('tbl_bill')->whereBetween('created_at',[$now,$now])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        }
        else if ($data['dashboard_value'] == '30ngay') {
            $get = DB::table('tbl_bill')->whereBetween('created_at',[$sub30days,$now])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        }
        else {
            $get = DB::table('tbl_bill')->whereBetween('created_at',[$sub365days,$now])
                ->select(\DB::raw('sum(bill_total) as bill_total'), \DB::raw('DATE(created_at) as created_at'))->groupBy('created_at')->orderBy('created_at')->get()->toArray();
        }


        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->created_at,
                'sales' => $val->bill_total,
            );
        }

        echo $data = json_encode($chart_data);
    }
}
