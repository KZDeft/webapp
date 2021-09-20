@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Brand
                </header>
                <div class="panel-body">
                    @foreach($edit_brand as $key => $edit_value)
                        <div class="position-center" >
                            <form role="form" action="{{URL::to('/update-brand/'.$edit_value->brand_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_name" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Description</label>
                                    <textarea type="text" style="resize: none" class="form-control" name="brand_desc"  rows="6">{{$edit_value->brand_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand Status</label>
                                    <select name="brand_status" class="form-control input-sm m-bot15">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" name="update_brand" class="btn btn-info">Update brand</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection


