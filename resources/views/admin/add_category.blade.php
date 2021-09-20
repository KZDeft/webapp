@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add new category
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
                    <form role="form" action="{{URL::to('save-category')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Category name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Status</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category" class="btn btn-info">Add new category</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

</div>
@endsection
