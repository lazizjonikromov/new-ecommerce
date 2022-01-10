@extends('layouts.master')
@section('content')

    	<!--main area-->
	<main id="main" class="main-site left-sidebar">

<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{url('/')}}" class="link">home</a></li>
            <li class="item-link"><span>Shop</span></li>
        </ul>
    </div>
    <div class="row">

        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

            <div class="banner-shop">
                <a href="#" class="banner-link">
                    <figure><img src="{{asset('assets/images/shop-banner.jpg')}}" alt=""></figure>
                </a>
            </div>

            <div class="wrap-shop-control">

                <h1 class="shop-title">All Categories</h1>

                <div class="wrap-right">

                    <div class="sort-item orderby ">
                        <select name="orderby" class="use-chosen" >
                            <option value="menu_order" selected="selected">Default sorting</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>

                    <div class="sort-item product-per-page">
                        <select name="post-per-page" class="use-chosen" >
                            <option value="12" selected="selected">12 per page</option>
                            <option value="16">16 per page</option>
                            <option value="18">18 per page</option>
                            <option value="21">21 per page</option>
                            <option value="24">24 per page</option>
                            <option value="30">30 per page</option>
                            <option value="32">32 per page</option>
                        </select>
                    </div>

                    <div class="change-display-mode">
                        <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                        <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                    </div>

                </div>

            </div><!--end wrap shop control-->

            <div class="row">

                <ul class="product-list grid-products equal-container">
                @if($products->count() > 0)
                    @foreach($products as $product)
                    <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
						
                        <div class="product product-style-3 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{url('/product_detail',['product'=>$product->id])}}" title="{{$product->title}}">
                                    <figure><img src="{{asset('uploads/images/'.$product->image)}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="{{url('/product_detail',['product'=>$product->id])}}" class="product-name"><span>{{$product->description}}</span></a>
                                <div class="wrap-price"><span class="product-price"style="font-size: 17px;">${{$product->price}}</span></div>
                                <form action="{{url('addcart',$product->id)}}" method="post">
                                    @csrf
                                    <div class="quantity">
                                        <span style="font-size: 16px;">Quantity:</span>
                                        
                                        <input type="number" name="quantity" class="form-control" style="width:100px;" value="1" min="1">
                                        
                                    </div>
                                    <br>
                                    <input type="submit" style="width: 110px;float:right;" value="Add Cart" class="btn btn-primary">
                                </form>    
                                <a href="{{url('/product_detail',['product'=>$product->id])}}" class="btn btn-success">View</a>
                            </div>
                        </div>
                        @endforeach
                        <div class="wrap-pagination-info">
                            <ul class="page-numbers">
                                {{ $products->links() }}
                            </ul>
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
                    </li>


                </ul>

            </div>

        </div><!--end main products area-->

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            @php
                $categories = \App\Models\Category::orderBy('created_at', 'DESC')->get()->take(10);
            @endphp
            <div class="widget mercado-widget categories-widget">
                <h2 class="widget-title">All Categories</h2>
                <div class="widget-content">
                    <ul class="list-category">
                        @foreach($categories as $category)
                        <li class="category-item">
                            <a href="{{url( '/shop/category',['product'=>$category->id])}}" class="cate-link">{{$category->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- Categories widget-->

            <div class="widget mercado-widget filter-widget brand-widget">
                <h2 class="widget-title">Brand</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list list-limited" data-show="6">
                        <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                        <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div><!-- brand widget-->

            <div class="widget mercado-widget filter-widget price-filter">
                <h2 class="widget-title">Price</h2>
                <div class="widget-content">
                    <div id="slider-range"></div>
                    <p>
                        <label for="amount">Price:</label>
                        <input type="text" id="amount" readonly>
                        <button class="filter-submit">Filter</button>
                    </p>
                </div>
            </div><!-- Price-->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Color</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list has-count-index">
                        <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                    </ul>
                </div>
            </div><!-- Color -->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Size</h2>
                <div class="widget-content">
                    <ul class="list-style inline-round ">
                        <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                        <li class="list-item"><a class="filter-link " href="#">M</a></li>
                        <li class="list-item"><a class="filter-link " href="#">l</a></li>
                        <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                    </ul>
                    <div class="widget-banner">
                        <figure><img src="{{asset('assets/images/size-banner-widget.jpg')}}" width="270" height="331" alt=""></figure>
                    </div>
                </div>
            </div><!-- Size -->

            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">Popular Products</h2>
                <div class="widget-content">
                    <ul class="products">
                        @php
                            $lproducts = \App\Models\Product::orderBy('created_at', 'DESC')->get()->take(4);
                        @endphp

                        <li class="product-item">
                        @foreach($lproducts as $lproduct)
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="{{url('/product_detail',['product'=>$lproduct->id])}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="{{asset('uploads/images/'.$lproduct->image)}}" alt=""></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{url('/product_detail',['product'=>$lproduct->id])}}" class="product-name"><span>{{$lproduct->description}}</span></a>
                                    <div class="wrap-price"><span class="product-price">${{$lproduct->price}}</span></div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        </li>

                    </ul>
                </div>
            </div>

        </div><!--end sitebar-->

    </div><!--end row-->

</div><!--end container-->

</main>
<!--main area-->

@endsection