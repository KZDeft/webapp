@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit category
                </header>
                <div class="panel-body">
                    @foreach($edit_category as $key => $edit_value)
                    <div class="position-center" >
                        <form role="form" action="{{URL::to('/update-category/'.$edit_value->category_id)}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" value="{{$edit_value->category_name}}" class="form-control" name="category_name" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Status</label>
                                <select name="category_status" class="form-control input-sm m-bot15">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" name="update_category" class="btn btn-info">Update category</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection

