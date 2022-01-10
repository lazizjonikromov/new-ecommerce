@extends('layouts.master')
@section('content')

<!--main area-->
	<main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{url('/')}}" class="link">home</a></li>
                    <li class="item-link"><span>checkout</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
            <form action="{{url('order')}}" method="post" name="frm-billing">
                @csrf
                    @foreach ($cart as $carts)
                        <input type="text" name="productname[]" value="{{$carts->product_title}}" hidden="">
                        <input type="text" name="quantity[]" value="{{$carts->quantity}}" hidden="">
                        <input type="text" name="price[]" value="{{$carts->price}}" hidden="">
                        <input type="text" name="totalprice[]" value="{{$carts->totalprice}}" hidden="">
                    @endforeach
                    <div>
                        <p class="row-in-form">
                            <label for="name">Name<span>*</span></label>
                            <input id="name" type="text" name="name" value="" placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email Addreess:</label>
                            <input id="email" type="email" name="email" value="" placeholder="Type your email">
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input id="phone" type="number" name="phone" value="" placeholder="10 digits format">
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address:</label>
                            <input id="add" type="text" name="address" value="" placeholder="Street at apartment number">
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input id="country" type="text" name="country" value="" placeholder="United States">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input id="city" type="text" name="city" value="" placeholder="City name">
                        </p>
                    </div>
                </div>
                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        <p class="summary-info"><span class="title">Check / Money order</span></p>
                        <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" value="bank" type="radio">
                                <span>Direct Bank Transder</span>
                                <span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-visa" value="visa" type="radio">
                                <span>visa</span>
                                <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                                <span>Paypal</span>
                                <span class="payment-desc">You can pay with your credit</span>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-danger">Place order now</button>
                    </div>
                </div>
            </form>
                

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
                                                <h1>No Related Products For this Product</h1>
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