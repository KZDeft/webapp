@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Choose Shipping Employee
            </div>
            <br>
            @foreach($order_by_id as $key => $value)
                <form role="form" action="{{URL::to('save-approve-order/')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$value->order_id}}" name="order_id">
                    <select name="employee_id" class="form-control input-sm m-bot15" style="width: 400px; margin: 0 auto">
                        @foreach($all_shipping_employee as $key => $employee)
                            @if($employee->role_id == 2)
                            <option value="{{$employee->employee_id}}">{{$employee->employee_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <br>
                    <div style="display: flex">
                        <button type="submit" class="btn btn-info" style="margin: 0 auto">Approve Order</button>
                    </div>
                    <br>
                </form>
            @endforeach





        </div>
    </div>
@endsection
