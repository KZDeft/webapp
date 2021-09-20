@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add new promotion
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
                        <form role="form" action="{{URL::to('save-sale')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion Description</label>
                                <input type="text" class="form-control" name="sale_desc" placeholder="Sale Description" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Promotion Type</label>
                                <select name="sale_type" class="form-control input-sm m-bot15">
                                    @foreach($all_promotion_type as $key => $promotion_type)
                                        <option value="{{$promotion_type->promotion_type_id}}">{{$promotion_type->promotion_type_desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion coupon</label>
                                <input type="text"  class="form-control" name="sale_coupon" placeholder="Sale Description" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion Value</label>
                                <input type="number" min="0" max="100" step="1" class="form-control" name="sale_value" placeholder="Value" value="1"required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date1" required>
                            </div>


                            <button type="submit" class="btn btn-info">Add new promotion</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection

