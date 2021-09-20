@extends('welcome')
@section('content')
    @foreach($product_detail as $key => $value)
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{URL::to('/uploads/products/'.$value->product_image)}}" alt="" />
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->

                <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$value->product_name}}</h2>
                <img src="images/product-details/rating.png" alt="" />
                <span>
                    <form>
                            @csrf
                            <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">

                            <input type="hidden"  value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">

                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">

                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">

                            <input type="hidden" class="cart_product_price_{{$value->product_id}}" value="{{$value->product_price}}">

                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
									<span>${{$value->product_price}}</span>
                        <p><b>Availability:</b>
                    @if($value->product_quantity>0)
                                In Stock
                            @endif
                            @if($value->product_quantity == 0)
                                Out of Stock
                            @endif
                </p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{$value->brand_name}}</p>
                <p><b>Category:</b> {{$value->category_name}}</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>

                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-product_id="{{$value->product_id}}">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>

                    </form>
								</span>



            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->


    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>

            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="details" >
                <p>{{$value->product_desc}}</p>
            </div>



            <div class="tab-pane fade" id="tag" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery2.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery3.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery4.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade " id="reviews" >
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>

                    <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                        <textarea name="" ></textarea>
                        <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/category-tab-->
    @endforeach

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">

                    @foreach($related_product as $key=>$related)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="product-info text-center">
                                    <img src="{{URL::to('uploads/products/'.$related->product_image)}}" height="150" width="150" alt="" />
                                    <h2 style="color: #FE980F">${{$related->product_price}}</h2>
                                    <p style="color: #696763">{{$related->product_name}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
