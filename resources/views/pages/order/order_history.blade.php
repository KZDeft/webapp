@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->
            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <p>Shipping To</p>
                            <div class="form-one">
                                <form action="{{URL::to('/save-order')}}" method="post">
                                    {{csrf_field()}}
                                    @foreach($customer as $key=>$value)
                                        <span for="exampleInputPassword1">Name</span>
                                        <input type="text" name="order_shipping_name" placeholder="Shipping Name" value="{{$value->customer_name}}" required>
                                        <span for="exampleInputPassword1">Address</span>
                                        <input type="text" name="order_shipping_address" placeholder="Address" value="{{$value->customer_address}}" required>
                                        <span for="exampleInputPassword1">Phone</span>
                                        <input type="text" name="order_shipping_phone" placeholder="Phone" value="{{$value->customer_phone}}" required>
                                        <span for="exampleInputPassword1">Email</span>
                                        <input type="text" name="order_shipping_email" placeholder="Email" value="{{$value->customer_email}}" required>
                                    @endforeach
                                    <span for="exampleInputPassword1">Payment Method</span>
                                    <select name="payment_method" class="form-control input-sm m-bot15" required>
                                        @foreach($all_payment_method as $key => $value)
                                            <option value="{{$value->payment_method_id}}">{{$value->payment_method_desc}}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-primary">Confirm Order</button>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info col-sm-8">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="name">Product Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['product_price']*$cart['product_qty'];

                        @endphp

                        <tr>
                            <td class="cart_product" style="margin-left: 0">
                                <img src="{{asset('uploads/products/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                            </td>
                            <td class="cart_name">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_name']}}</p>
                            </td>

                            <td class="cart_price">
                                <p>${{$cart['product_price']}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <p>{{$cart['product_qty']}}</p>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    ${{$subtotal}}
                                </p>
                            </td>

                        </tr>

                    @endforeach


                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                @php
                                    $cart_amount = Session::get('cart_amount')
                                @endphp

                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>${{$cart_amount['cart_subtotal']}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping fee</td>
                                    <td>Free</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Discount</td>
                                    <td>${{$cart_amount['cart_discount']}}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>${{$cart_amount['cart_total']}}</span></td>
                                    <input type="hidden" id="cart_total" value="{{$cart_amount['cart_total']}}" >
                                </tr>

                            </table>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection


