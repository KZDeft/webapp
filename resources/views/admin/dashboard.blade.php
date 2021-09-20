@extends('admin_layout')
@section('admin_content')
<div class="row">
    <h3 class="title_thongke" style="text-align: center">Sales Statistics</h3>

    <form autocomplete="off" >
        @csrf

{{--        <div class="col-md-2">--}}
{{--            <p>From: <input type="date" id="datepicker"  class="form-control"></p>--}}
{{--            <br>--}}
{{--            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Filter"></p>--}}

{{--        </div>--}}

{{--        <div class="col-md-2">--}}
{{--            <p>To: <input type="date" id="datepicker2" class="form-control"></p>--}}

{{--        </div>--}}

        <div class="col-md-2">
            <p>
                Filter:
                <select class="dashboard-filter form-control">
                    <option value="30ngay">Last 30 days</option>
                    <option value="homnay">Today</option>
                    <option value="7ngay">Last 7 days</option>
                    <option value="thangtruoc">Last month</option>
                    <option value="thangnay">This Month</option>
                    <option value="365ngayqua">Last 365 days</option>
                </select>
            </p>
        </div>

    </form>
    <div class="col-md-12">
        <div id="chart" style="height: 250px; color: red;"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <h3 class="title_thongke" style="text-align: center"> Order Statistics</h3>
            <div style="display: flex;">
                <div class="col-md-5 col-xs-12 justify-content-center">
                    <div id="donut-example"></div>
                </div>
                <div class="col-md-4 col-xs-12" style="padding-top:8rem">
                    <div><i class="fa fa-circle" style="color:#F11142;"></i> <span style="font-weight: 700;"> : Unapproved Order </span></div>
                    <div><i class="fa fa-circle" style="color:#4211F1;"></i> <span style="font-weight: 700;"> : Shipping Order</span></div>
                    <div><i class="fa fa-circle" style="color:#11DBF1;"></i> <span style="font-weight: 700;"> : Completed Order</span></div>
                    <div><i class="fa fa-circle" style="color:#11F137;"></i> <span style="font-weight: 700;"> : Canceled Order</span></div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
