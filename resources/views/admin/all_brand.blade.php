@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Brand List
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
                        <th>Description</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Update Date</th>
                        <th>Manage</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_brand as $key => $brand)
                        <tr>
                            <td>{{$brand->brand_name}}</td>
                            <td>{{$brand->brand_desc}}</td>
                            <td>
                            <span class="text-ellipsis">
{{--                                {{$category->category_status}}--}}
                                @if($brand->brand_status)
                                    Active
                                @endif
                                @if(!($brand->brand_status))
                                    Inactive
                                @endif
                            </span>
                            </td>
                            <td><span class="text-ellipsis">{{$brand->created_at}}</span></td>
                            <td><span class="text-ellipsis">{{$brand->updated_at}}</span></td>
                            <td>
                                <a href="{{URL::to('/edit-brand/'.$brand->brand_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i></a>
                                <a onclick="return confirm('Are you sure to delete this brand?')" href="{{URL::to('/delete-brand/'.$brand->brand_id)}}" class="active" ui-toggle-class="" style="padding-left: 10px"><i class="fa fa-times text-danger text" style="font-size: 20px"></i></a>
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
                        {{ $all_brand->links() }}
                        <ul class="pagination pagination-sm m-t-none m-b-none">

                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

