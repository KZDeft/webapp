@extends('admin_layout')
@section('admin_content')
    <?php
    $message = Session::get('message');
    $admin_role = Session::get('admin_role');
    $admin_id = Session::get('admin_id');
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Completed Order
            </div>
            <div class="row w3-res-tb">
                <a href="{{URL::to('/all-order')}}"><button  class="btn btn-info" style="margin: 0 auto">All Order</button></a>
                <a href="{{URL::to('/unapproved-order')}}"><button  class="btn btn-info" style="margin: 0 auto">Unapproved Order</button></a>
                <a href="{{URL::to('/approved-order')}}"><button  class="btn btn-info" style="margin: 0 auto">Shipping Order</button></a>
                <a href="{{URL::to('/completed-order')}}"><button  class="btn btn-info" style="margin: 0 auto">Completed Order</button></a>
                <a href="{{URL::to('/canceled-order')}}"><button  class="btn btn-info" style="margin: 0 auto">Canceled Order</button></a>




            </div>
            <br>
            <div class="table-responsive">
                <?php
                if($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Approved Employee</th>
                        <th>Shipping Employee</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Manage</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_order as $key => $ord)

                        <tr>

                            <td>{{ $ord->customer_name }}</td>
                            <td>{{ $ord->employee_name }}</td>
                            <td>
                                @if($ord->shipping_employee_id)
                                    {{$ord->shipping_employee_name}}
                                @else
                                    Unapproved
                                @endif
                            </td>


                            <td>@if($ord->order_status==0)
                                    Unapproved
                                @elseif($ord->order_status==1)
                                    Approved, Shipping
                                @elseif($ord->order_status==2)
                                    Completed
                                @elseif($ord->order_status==3)
                                    Cancelled
                                @endif
                            </td>

                            <td>{{ $ord->created_at }}</td>
                            <td>
                                <a href="{{URL::to('/view-order/'.$ord->order_id)}}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-eye text-success text-active"></i></a>
                                @if($ord->order_status==0 && $admin_role == 1)

                                    <a href="{{URL::to('/approve-order/'.$ord->order_id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-truck text-success text"></i>
                                    </a>
                                @endif
                                @if($ord->order_status == 1 && $admin_id == $ord->shipping_employee_id)
                                    <a href="{{URL::to('/complete-order/'.$ord->order_id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-check-circle text-success text"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{$all_order->links()}}
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>
@endsection


