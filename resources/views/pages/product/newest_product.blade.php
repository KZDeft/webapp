@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Newest Products</h2>

        @foreach($all_product as $key => $product)


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
                                @if($product->product_quantity > 0)
                                    <button type="button" name="add-to-cart" data-product_id="{{$product->product_id}}"  class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                @else
                                    <button type="button" name="add-to-cart" data-product_id="{{$product->product_id}}"  class="btn btn-default add-to-cart" disabled ><i class="fa fa-shopping-cart"></i>Out of Stock</button>
                                @endif
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
        @endforeach



    </div><!--features_items-->

    <div class="row" style="display: flex; justify-content: center">
        <div class="d-flex justify-content-center  text-center-xs">

            <ul class="pagination pagination-sm m-t-none m-b-none">
                {{ $all_product->links() }}
            </ul>
        </div>
    </div>

@endsection

