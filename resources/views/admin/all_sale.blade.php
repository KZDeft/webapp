@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Promotion List
            </div>
            <?php
            $message = Session::get('message');
            if($message) {
                echo $message;
                Session::put('message', null);
            }
            ?>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Created by</th>
                        <th>Description</th>
                        <th>Promotion Type</th>
                        <th>Coupon</th>
                        <th>Value</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Create Date</th>
                        <th>Update Date</th>
                        <th>Manage</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_sale as $key => $sale)
                        <tr>
                            <td>{{$sale->employee_name}}</td>
                            <td>{{$sale->promotion_desc}}</td>
                            <td>{{$sale->promotion_type_desc}}</td>
                            <td>{{$sale->promotion_coupon}}</td>
                            @if($sale->promotion_type_id == 1)
                                <td>{{$sale->promotion_value}}%</td>
                            @else
                                <td>${{$sale->promotion_value}}</td>
                            @endif
                            <td><span class="text-ellipsis">{{$sale->start_date}}</span></td>
                            <td><span class="text-ellipsis">{{$sale->end_date}}</span></td>
                            <td><span class="text-ellipsis">{{$sale->created_at}}</span></td>
                            <td><span class="text-ellipsis">{{$sale->updated_at}}</span></td>
                            <td>
                                <a href="{{URL::to('/edit-sale/'.$sale->promotion_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i></a>
                                <a onclick="return confirm('Are you sure to delete this sale?')" href="{{URL::to('/delete-sale/'.$sale->promotion_id)}}" class="active" ui-toggle-class="" style="padding-left: 10px"><i class="fa fa-times text-danger text" style="font-size: 20px"></i></a>
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
                            {{$all_sale->links()}}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

