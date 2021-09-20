@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Brand
                </header>
                <div class="panel-body">
                    @foreach($edit_product as $key => $edit_value)
                        <div class="position-center" >
                            <form role="form" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand </label>
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                        @foreach($all_brand as $key => $brand)
                                            @if($brand->brand_id == $edit_value->brand_id)
                                                <option value="{{$brand->brand_id}}" selected="selected">{{$brand->brand_name}}</option>
                                            @endif
                                            @if($brand->brand_id != $edit_value->brand_id)
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category </label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach($all_category as $key => $category)
                                            @if($category->category_id == $edit_value->category_id)
                                                <option value="{{$category->category_id}}" selected="selected">{{$category->category_name}}</option>
                                            @endif
                                            @if($category->category_id != $edit_value->category_id)
                                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" value="{{$edit_value->product_name}}" class="form-control" name="product_name" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Image</label>
                                    <input type="file" class="form-control" name="product_image">
                                </div>
                                <img src="{{URL::to('uploads/products/'.$edit_value->product_image)}}" height="100" width="100">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Description</label>
                                    <textarea type="text" style="resize: none" class="form-control" name="product_desc"  rows="6">{{$edit_value->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Price</label>
                                    <input type="number" min="0" step="0.01" class="form-control" value="{{$edit_value->product_price}}" name="product_price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Status</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        @if($edit_value->product_status)
                                            <option value="1" selected="selected">Active</option>
                                            <option value="0">Inactive</option>
                                        @endif
                                        @if(!$edit_value->product_status)
                                                <option value="1">Active</option>
                                                <option value="0" selected="selected">Inactive</option>
                                        @endif
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" name="update_product" class="btn btn-info">Update product</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection



