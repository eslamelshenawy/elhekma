@extends('layouts.header')
@section('content')

<!-- Hero Section Start -->
<div class="hero-section section mb-30" >
    <div class="container">
        <div class="row">
            <div class="col" >
                    @include('slider')
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- Banner Section Start -->
<div class="banner-section section mb-60">
    {{--  <div class="container">
        <div class="row row-10">

            <!-- Banner -->
            <div class="col-md-8 col-12 mb-30">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-1.jpg" alt="Banner"></a></div>
            </div>

            <!-- Banner -->
            <div class="col-md-4 col-12 mb-30">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-2.jpg" alt="Banner"></a></div>
            </div>

        </div>
    </div>
</div>  --}}
<!-- Banner Section End -->

<!-- Feature Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title=""><h1>@lang('trans.featured_products')</h1></div>
            </div><!-- Section Title End -->

            <!-- Product Tab Filter Start -->
            <div class="col-12 mb-30">
                <div class="product-tab-filter">

                    <!-- Tab Filter Toggle -->
                    {{--  <button class="product-tab-filter-toggle">showing: <span></span><i class="icofont icofont-simple-down"></i></button>  --}}

                    <!-- Product Tab List -->
                    {{--  <ul class="nav product-tab-list">
                     		    <li><a class="active" data-toggle="tab" href="#tab-one">@lang('trans.all')</a></li>
     						    <li><a data-toggle="tab" href="#tab-four">@lang('trans.baby_needs')</a></li>
                                <li><a data-toggle="tab" href="#tab-three">@lang('trans.diet')</a></li>
                                {{--  <li><a data-toggle="tab" href="#tab-four">@lang('trans.bath')Bath & Spa</a></li>  --}}
                                {{--  <li><a data-toggle="tab" href="#tab-three">@lang('trans.vitamin')</a></li>
                                <li><a data-toggle="tab" href="#tab-four">@lang('trans.ear_care')</a></li>
                     </ul>    --}}

                </div>
            </div><!-- Product Tab Filter End -->

            <!-- Product Tab Content Start -->

            <div class="col-12" style="direction:ltr">
                <div class="tab-content">

                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab-one">

                        <!-- Product Slider Wrap Start -->
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <!-- Product Slider Start -->
                            <div class="product-slider product-slider-4">

                                @include('featuredProducts')

                            </div><!-- Product Slider End -->
                        </div><!-- Product Slider Wrap End -->

                    </div><!-- Tab Pane End -->

                    <!-- Tab Pane Start -->

        </div>
    </div>
</div><!-- Feature Product Section End -->

<!-- Best Sell Product Section Start -->
<div class="product-section section mb-60">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title=""><h1>@lang('trans.best_sellers')</h1></div>
            </div><!-- Section Title End -->

            <div class="col-12">
                <div class="row">

            @include('bestSellers')

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Best Sell Product Section End -->

<!-- Banner Section Start -->
{{--  <div class="banner-section section mb-90">
    <div class="container">
        <div class="row">

            <!-- Banner -->
            <div class="col-12">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-3.jpg" alt="Banner"></a></div>
            </div>

        </div>
    </div>
</div>  --}}
<!-- Banner Section End -->

<!-- Feature Section Start -->
{{--  <div class="feature-section section mb-60">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-12 mb-30">
                <!-- Feature Start -->
                <div class="feature feature-shipping">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-van.png" alt="Feature"></div>
                        <h4>@lang('trans.free_shipping')</h4>
                        <p>@lang('trans.start_from') $100</p>
                    </div>
                </div><!-- Feature End -->
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-30">
                <!-- Feature Start -->
                <div class="feature feature-guarantee">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-walet.png" alt="Feature"></div>
                        <h4>@lang('trans.money_back')</h4>
                        <p>@lang('trans.back_days')</p>
                    </div>
                </div><!-- Feature End -->
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-30">
                <!-- Feature Start -->
                <div class="feature feature-security">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-shield.png" alt="Feature"></div>
                        <h4>@lang('trans.secure_payments')</h4>
                        <p>@lang('trans.payment_security')</p>
                    </div>
                </div>
                <!-- Feature End -->
            </div>

        </div>
    </div>
</div>  --}}
<!-- Feature Section End -->

<!-- Best Deals Product Section Start -->
{{--  <div class="product-section section mb-40">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title=""><h1>@lang('trans.best_deals')</h1></div>
            </div><!-- Section Title End -->

            <!-- Product Tab Filter Start-->
            <div class="col-12">
                <div class="offer-product-wrap row" >

                    <!-- Product Tab Filter Start -->
                    <div class="col mb-30">
                        <div class="product-tab-filter">
                            <!-- Tab Filter Toggle -->
                            <button class="product-tab-filter-toggle">showing: <span></span><i class="icofont icofont-simple-down"></i></button>

                            <!-- Product Tab List -->
                            <ul class="nav product-tab-list">
                                <li><a class="active" data-toggle="tab" href="#tab-one">@lang('trans.all')</a></li>
     						    <li><a data-toggle="tab" href="#tab-four">@lang('trans.baby_needs')</a></li>
                                <li><a data-toggle="tab" href="#tab-three">@lang('trans.diet')</a></li>
                                {{--  <li><a data-toggle="tab" href="#tab-four">@lang('trans.bath')Bath & Spa</a></li>  --}}
                                {{--  <li><a data-toggle="tab" href="#tab-three">@lang('trans.vitamin')</a></li>
                                <li><a data-toggle="tab" href="#tab-four">@lang('trans.ear_care')</a></li>
                            </ul>  --}}

                        {{--  </div>
                    </div>  --}}
                    <!-- Product Tab Filter End -->

                    <!-- Offer Time Wrap Start -->
                    {{--  <div class="col mb-30" style="direction:ltr;">
                        <div class="offer-time-wrap" style="background-image: url(assets/images/bg/offer-products.jpg)">
                            <h1><span>UP TO</span> 55%</h1>
                            <h3>QUALITY & EXCLUSIVE <span>PRODUCTS</span></h3>
                            <h4><span>LIMITED TIME OFFER</span> GET YOUR PRODUCT</h4>
                            <div class="countdown" data-countdown="2019/06/20"></div>
                        </div>
                    </div>  --}}
                    {{--  <!-- Offer Time Wrap End -->

                    <!-- Product Tab Content Start -->  --}}
                    {{--  <div class="col-12 mb-30" style="direction:ltr;">
                        <div class="tab-content">

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab-three">

                                <!-- Product Slider Wrap Start -->
                                <div class="product-slider-wrap product-slider-arrow-two">
                                    <!-- Product Slider Start -->
                                    <div class="product-slider product-slider-3">

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label sale">sale</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-13.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>  --}}

                                                {{--  <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Medical Devices</a>
                                                        <h5 class="title"><a href="single-product.html">Game Stations PW 25</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$285</span>$135.35</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>  --}}

                                        {{--  <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-14.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Baby Needs</a>
                                                        <h5 class="title"><a href="single-product.html">Zorex Coffe Maker</a></h5>

                                                    </div>  --}}
{{--
                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price">$125.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label sale">sale</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-15.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Bath & Spa</a>
                                                        <h5 class="title"><a href="single-product.html">jeilips Steam Iron K 2</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$365</span>$295.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label sale">sale</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-16.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>  --}}

                                                {{--  <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Makeup</a>
                                                        <h5 class="title"><a href="single-product.html">Nexo Andriod TV Box</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$360 </span>$250.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label new">new</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-17.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Personal Care</a>
                                                        <h5 class="title"><a href="single-product.html">Ornet Note 9</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$285</span>$230.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                    </div><!-- Product Slider End -->
                                </div><!-- Product Slider Wrap End -->

                            </div><!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade" id="tab-four">

                                <!-- Product Slider Wrap Start -->
                                <div class="product-slider-wrap product-slider-arrow-two">
                                    <!-- Product Slider Start -->
                                    <div class="product-slider product-slider-3">

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-18.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Makeup</a>
                                                        <h5 class="title"><a href="single-product.html">Xonet Speaker P 9</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price">$185.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-24.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Personal Care</a>
                                                        <h5 class="title"><a href="single-product.html">Sany Experia Z5</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price">$360.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label sale">sale</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-20.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Baby Needs</a>
                                                        <h5 class="title"><a href="single-product.html">Jackson Toster V 27</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$185</span>$135.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-21.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Baby Needs</a>
                                                        <h5 class="title"><a href="single-product.html">mega Juice Maker</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price">$125.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                        <div class="col pb-20 pt-10">
                                            <!-- Product Start -->
                                            <div class="ee-product">

                                                <!-- Image -->
                                                <div class="image">

                                                    <span class="label new">new</span>

                                                    <a href="single-product.html" class="img"><img src="assets/images/product/product-22.png" alt="Product Image"></a>

                                                    <div class="wishlist-compare">
                                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                                        <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                                    </div>

                                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                                </div>

                                                <!-- Content -->
                                                <div class="content">

                                                    <!-- Category & Title -->
                                                    <div class="category-title">

                                                        <a href="#" class="cat">Baby Needs</a>
                                                        <h5 class="title"><a href="single-product.html">shine Microwave Oven</a></h5>

                                                    </div>

                                                    <!-- Price & Ratting -->
                                                    <div class="price-ratting">

                                                        <h5 class="price"><span class="old">$389</span>$245.00</h5>
                                                        <div class="ratting">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- Product End -->
                                        </div>

                                    </div><!-- Product Slider End -->
                                </div><!-- Product Slider Wrap End -->

                            </div><!-- Tab Pane End -->

                        </div>
                    </div><!-- Product Tab Content End -->

                </div>
            </div><!-- Product Tab Filter End-->

        </div>
    </div>
</div>  --}}
<!-- Best Deals Product Section End -->

<!-- New Arrival Product Section Start -->
<div class="product-section section mb-60">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title=""><h1>@lang('trans.new_arrival')</h1></div>
            </div><!-- Section Title End -->

            <div class="col-12">
                <div class="row">

                    @include('newArrival')

                </div>
            </div>

        </div>
    </div>
</div><!-- New Arrival Product Section End -->

<!-- Banner Section Start -->
<div class="banner-section section mb-60">
    <div class="container">
        <div class="row">

                @include('ads')

        </div>
    </div>
</div><!-- Banner Section End -->
@include('layouts.brands')

@include('layouts.subscribe')
@endsection

