@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Information
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>


                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        @foreach($customer_by_id as $key => $customer)
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_phone}}</td>
                        <td>{{$customer->customer_email}}</td>
                        @endforeach
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br>
    <div class="table-agile-info container">

        <div class="panel panel-default">
            <div class="panel-heading">
                Shipping Infomation
            </div>


            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Shipping Name</th>
                        <th>Shipping Address</th>
                        <th>Shipping Phone</th>
                        <th>Shipping Email</th>
                        <th>Payment Method</th>


                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        @foreach($order_by_id as $key => $order)
                        <td>{{$order->order_shipping_name}}</td>
                        <td>{{$order->order_shipping_address}}</td>
                        <td>{{$order->order_shipping_phone}}</td>
                        <td>{{$order->order_shipping_email}}</td>
                        <td>@if($order->payment_method_id==1) Cash @else Paypal @endif</td>
                        @endforeach

                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br><br>
    <div class="table-agile-info container">

        <div class="panel panel-default">
            <div class="panel-heading">
                Order Details
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($detail_by_id as $detail)
                        <tr>
                            <td>{{$detail->product_name}}</td>
                            <td>
                                <img src="{{URL::to('uploads/products/'.$detail->product_image)}}" height="100" width="100">
                            </td>
                            <td>${{$detail->product_price}}</td>
                            <td>{{$detail->product_quantity}}</td>
                            <td>${{$detail->product_total}}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br><br>
    <div class="table-agile-info container">

        <div class="panel-heading">
            Bill
        </div>
        @foreach($bill_by_id as $key => $bill )
            <table class="table table-striped b-t b-light">

                <tr>
                    <td>Sub Total</td>
                    <td>${{$bill->bill_subtotal}}</td>
                </tr>
                <tr>
                    <td>Shipping fee</td>
                    <td>Free</td>
                </tr>
                <tr class="shipping-cost">
                    <td>Discount</td>
                    <td>${{$bill->bill_discount}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><span>${{$bill->bill_total}}</span></td>
                </tr>
            </table>
        @endforeach
    </div>
@endsection
