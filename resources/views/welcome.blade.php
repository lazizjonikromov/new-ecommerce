@extends('layouts.master')
@section('content')

			<!--MAIN SLIDE-->
	        <div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					@php
						$lproducts = \App\Models\Product::orderBy('created_at', 'DESC')->get()->take(3);        
					@endphp

					@if($lproducts->count() > 0)
					@foreach($lproducts as $lproduct)
						<div class="item-slide" style="width: 500px; height:auto;">
							<img src="{{asset('uploads/images/'.$lproduct->image)}}" alt="" class="img-slide">
							<div class="slide-info slide-1" style="background-color: grey; opacity:0.9;padding:20px;border-radius:5px; position:absolute;">
								<h2 class="f-title" style="color: red;">{{$lproduct->title}}</h2>
								<span class="subtitle" style="color: white;">{{$lproduct->description}}</span>
								<p class="sale-info" style="color: white;">Only price: <span class="price">${{$lproduct->price}}</span></p>
								<a href="{{url('/product_detail',['product'=>$lproduct->id])}}" title="{{$lproduct->title}}" class="btn-link">Shop Now</a>
							</div>
						</div>
					@endforeach
					@else
						<div class="col-md-12 my-4">
							<div class="d-flex justify-content-center mt-4">
								<div class="">
									<p>No Related Products For this Latest Product</p>
								</div>
							</div>
						</div>
					@endif
				</div>
		    </div>



			<!-- On Sale -->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">On Sale</h3>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
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
				</div>
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
			
			

		

@endsection