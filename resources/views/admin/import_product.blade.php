@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Import Product
                </header>
                <div class="panel-body">
                    @foreach($edit_product as $key => $edit_value)
                        <div class="position-center" >
                            <form role="form" action="{{URL::to('/save-import-product/'.$edit_value->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name:  </label>
                                    {{$edit_value->product_name}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Image:</label>
                                </div>
                                <img src="{{URL::to('uploads/products/'.$edit_value->product_image)}}" height="100" width="100">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Remaining quantity: {{$edit_value->product_quantity}}</label>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Add quantity:   </label>
                                    <input type="number" min="0" step="1" class="form-control" value="1" name="product_quantity">
                                </div>

                                <button type="submit" name="save_import_product" class="btn btn-info">Import product</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection



