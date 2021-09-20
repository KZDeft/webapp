@extends('welcome')
@section('content')

    <section id="cart_items">
        <div class="">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Cart Home</li>
                </ol>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message') !!}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="table-responsive cart_info">

                <form action="{{url('/update-cart')}}" method="POST">
                    @csrf
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="name">Product Name</td>
                            <td class="remain_quantity">Remain Quantity</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td class="manage">Manage</td>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                            $cart_total = 0;
                            $discount = 0;
                        @endphp
                        @if(Session::get('cart')==true)

                            @foreach(Session::get('cart') as $key => $cart)
                                @php
                                    $subtotal = $cart['product_price']*$cart['product_qty'];
                                    $total+=$subtotal;
                                @endphp

                                <tr>
                                    <td class="cart_product">
                                        <img src="{{asset('uploads/products/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                                    </td>
                                    <td class="cart_name">
                                        <h4><a href=""></a></h4>
                                        <p>{{$cart['product_name']}}</p>
                                    </td>
                                    <td class="cart_remain_quantity">
                                        <h4><a href=""></a></h4>
                                        <p>{{$cart['product_quantity']}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{$cart['product_price']}}$</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">

                                            <input class="cart_quantity" type="number" min="1" max="{{$cart['product_quantity']}}" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" style="width: 50px ">


                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            ${{$subtotal}}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                            <tr>
                                <td><input type="submit" value="Update Cart" name="update_qty" class="check_out btn btn-default btn-sm"></td>
                                <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Delete Cart</a></td>
                                <td>

                                </td>

                                <td>
{{--                                    @if(Session::get('customer_id'))--}}
{{--                                        <a class="btn btn-default check_out" href="{{url('/checkout')}}">Đặt hàng</a>--}}
{{--                                    @else--}}
{{--                                        <a class="btn btn-default check_out" href="{{url('/dang-nhap')}}">Đặt hàng</a>--}}
{{--                                    @endif--}}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5">
                                    <center>
                                        @php
                                            echo 'Please add product to cart';
                                        @endphp
                                    </center>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </form>
                <form action="{{URL::to('/checkout')}}" method="post">
                    {{@csrf_field()}}
                    <div class="cart-total">
                        <table cellspacing="0">
                            <thead>
                            <tr>
                                <th class="product-name" colspan="2" style="border-width:3px;">Cart Information
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <table cellspacing="0" class="shop_table" style="width:100%">
                            <tbody>
                            @php
                                $cart_total = $total;
                            $discount = 0;
                            if(Session::get('promotion_type')) {
                                if(Session::get('promotion_type') == 1) {
                                    $discount = $total * Session::get('promotion_value') /100;
                                }
                                else {
                                    $discount = Session::get('promotion_value');
                                }
                                $cart_total = $cart_total - $discount;
                            }
                            @endphp
                            <input type="hidden" name="cart_subtotal" value="{{$total}}">
                            <input type="hidden" name="cart_discount" value="{{$discount}}">
                            <input type="hidden" name="cart_total" value="{{$cart_total}}">
                            <tr class="cart-subtotal">
                                <th>Subtotal :</th>
                                <td data-title="Tạm tính">
                                        <span class="amount">
                                            <bdo dir="">${{$total}}</bdo>
                                        </span>
                                </td>
                            </tr>
                            <tr class="shipping ">
                                <th>Shipping fee :</th>
                                <td data-title="Tạm tính">
                                        <span class="amount">
                                            <bdo dir=""><span>Free</span></bdo>
                                        </span>
                                </td>
                            </tr>
                            <tr class="shipping ">
                                <th>Discount:</th>
                                <td data-title="Tạm tính">
                                        <span class="amount">
                                            <bdo dir=""><span>${{$discount}}</span></bdo>
                                        </span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Total :</th>
                                <td data-title="Tạm tính">
                                        <span class="amount">
                                            <bdo dir="">${{$cart_total}}</bdo>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="payment">
                        @if(Session::get('customer_id'))
                            @if(Session::get('cart'))
                            <button type="submit" class="btn btn-default check_out">Order</button>
                            @else
                                <button type="submit" class="btn btn-default check_out" disabled>Order</button>
                            @endif
                        @else
                            <a class="btn btn-default btn-lg check_out" href="{{url('/login')}}">Order</a>
                        @endif
                    </div>

                </form>
                @if(Session::get('cart'))
                    <?php
                    $message_coupon = Session::get('message_coupon');
                    if($message_coupon) {
                        echo $message_coupon;
                        Session::put('message_coupon', null);
                    }
                    ?>
                    <form class="checkout_coupon mb-0" action="{{URL::to('/check-coupon')}}" method="post" style="margin-top: 20px">
                        {{@csrf_field()}}
                        <div class="coupon">
                            <p class="widget-title"><i class="fa fa-tags"></i> Coupon</p>
                        </div>
                        <input type="text" name="coupon_code" id="coupon_code" class="input-text"
                               placeholder="Coupon">
                        <input type="submit" value="Apply" name="apply_coupon" class="is-form expand">
                    </form>

                    <ul style="margin-top: 20px">
                        <h5>Coupon Available</h5>
                        @foreach($all_promotion as $key => $promotion)
                            <li>
                                @if($promotion->promotion_type_id == 1)
                                    <span>{{$promotion->promotion_coupon}}: Discount {{$promotion->promotion_value}}% on bill.</span>
                                @else
                                    <span>{{$promotion->promotion_coupon}}: Discount ${{$promotion->promotion_value}} on bill.</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
    <!--/#cart_items-->



@endsection
