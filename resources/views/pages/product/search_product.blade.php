@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Search Results</h2>
        @foreach($search_product as $key => $product)

                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="product-info text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                                    <input type="hidden"  value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                                    <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">

                                    <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">

                                    <input type="hidden" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">

                                    <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">

                                    <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                <img src="{{URL::to('uploads/products/'.$product->product_image)}}"  height="300" width="200" alt="" />
                                <h2 style="color: #FE980F">${{$product->product_price}}</h2>
                                <p style="color: #696763">{{$product->product_name}}</p>
                                <p style="color: #696763">Remaining {{$product->product_quantity}} products</p>
                                </a>
                                    <button type="button" name="add-to-cart" data-product_id="{{$product->product_id}}"  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

    </div><!--features_items-->

@endsection

