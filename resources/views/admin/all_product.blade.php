@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Product List
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

                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Manage</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_product as $key => $product)
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->brand_name}}</td>
                            <td>{{$product->product_desc}}</td>
                            <td>
                            <span class="text-ellipsis">
                                @if($product->product_status)
                                    Active
                                @endif
                                @if(!($product->product_status))
                                    Inactive
                                @endif
                            </span>
                            </td>
                            <td>
                                <img src="uploads/products/{{$product->product_image}}" height="100" width="100">
                            </td>
                            <td>{{$product->product_price}}$</td>
                            <td><span class="text-ellipsis">{{$product->product_quantity}}</span></td>

                            <td>
                                <a href="{{URL::to('/import-product/'.$product->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-plus-circle text-success text-active" style="font-size: 20px; margin-right: 10px"></i></a>
                                <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i></a>
                                <a onclick="return confirm('Are you sure to delete this product?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active" ui-toggle-class="" style="padding-left: 10px"><i class="fa fa-times text-danger text" style="font-size: 20px"></i></a>
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
                            {{$all_product->links()}}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection


