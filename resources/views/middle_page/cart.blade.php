@extends('layouts.master')
@section('content')

    <!--main area-->
        <main id="main" class="main-site">

            <div class="container">

                <div class="wrap-breadcrumb">
                    <ul>
                        <li class="item-link"><a href="{{url('/')}}" class="link">home</a></li>
                        <li class="item-link"><span>cart</span></li>
                    </ul>
                </div>
                <div class=" main-content-area">

                    <div class="wrap-iten-in-cart">
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            @if ($cart->count() > 0 )
                            @foreach ($cart as $carts)
                                <li class="pr-cart-item">
                                    <div class="product-image">
                                        <figure><img src="{{asset('uploads/images/'.$carts->image)}}" alt=""></figure>
                                    </div>
                                    <div class="product-name">
                                        <a class="link-to-product" href="#">Name: {{$carts->product_title}}</a>
                                    </div>
                                    <div class="price-field produtc-price"><p class="price">Price: ${{$carts->price}}</p></div>
                                    <div class="price-field produtc-price"><p class="price">Quantity:  {{$carts->quantity}}</p></div>
                                    <div class="price-field sub-total"><p class="price">Total Price: ${{$carts->totalprice}}</p></div>
                                    <div class="delete">
                                        <a href="{{url('delete', $carts->id)}}" class="btn btn-danger" style="margin-bottom: 10px; padding:10px;">Delete</a>
                                    </div>
                                </li>
                            @endforeach
                                <div class="summary" align="center">
                                    <div class="checkout-info">
                                        <a class="btn btn-success" href="{{url('/shop')}}">← Continue Shopping</a>
                                        <a class="btn btn-primary" href="{{url('/checkout')}}">Check out</a>
                                    </div>
                                </div>
                            @else
                                <div align="center">
                                    <h1 style="font-size:30px;">No Cart</h1>
                                    <br>
                                    <a href="{{url('/shop')}}" class="btn btn-success">← Shop</a>
                                </div>
                            @endif
                        </ul>
                    </div>

                    
                    <div class="wrap-show-advance-info-box style-1 box-in-site">
                        <h3 class="title-box">Most Viewed Products</h3>
                        <div class="wrap-products">
                            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                                @if($products->count() > 0)
                                @foreach($products as $product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{url('/product_detail',['product'=>$product->id])}}" title="{{$product->title}}">
                                                    <figure><img src="{{asset('uploads/images/'.$product->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item sale-label">sale</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="{{url('/product_detail',['product'=>$product->id])}}" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{url('/product_detail',['product'=>$product->id])}}" class="product-name"><span>{{$product->description}}</span></a>
                                                <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>
                                            </div>
                                        </div>
                                @endforeach	
                                @else
                                    <div class="col-md-12 my-4">
                                        <div class="d-flex justify-content-center mt-4">
                                            <div class="">
                                                <p>No Related Products For this Product</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div><!--End wrap-products-->
                    </div>

                </div><!--end main content area-->
            </div><!--end container-->

        </main>
    <!--main area-->

@endsection