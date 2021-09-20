@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add new product
                </header>
                <?php
                $message = Session::get('message');
                if($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center" >
                        <form role="form" action="{{URL::to('save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Brand </label>
                                <select name="brand_id" class="form-control input-sm m-bot15">
                                    @foreach($all_brand as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div><div class="form-group">
                                <label for="exampleInputPassword1">Category</label>
                                <select name="category_id" class="form-control input-sm m-bot15">
                                    @foreach($all_category as $key => $category)
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Image</label>
                                <input type="file" class="form-control" name="product_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Description</label>
                                <textarea type="text" style="resize: none" class="form-control" name="product_desc" placeholder="Product Description" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="number" min="0" step="0.01" class="form-control" name="product_price" placeholder="Product Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Status</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" name="add_brand" class="btn btn-info">Add new product</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection


