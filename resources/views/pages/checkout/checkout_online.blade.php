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
                            <p>Bill detail</p>
                            <div class="form-one">
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
                                <div id="paypal-button-container"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection


