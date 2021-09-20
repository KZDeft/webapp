@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add new brand
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
                        <form role="form" action="{{URL::to('save-brand')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Description</label>
                                <textarea type="text" style="resize: none" class="form-control" name="brand_desc" placeholder="Brand Description" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Brand Status</label>
                                <select name="brand_status" class="form-control input-sm m-bot15">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" name="add_brand" class="btn btn-info">Add new brand</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection

