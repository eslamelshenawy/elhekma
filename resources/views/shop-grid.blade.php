@extends('layouts.header')
@section('content')
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>Personal Care</h1>
                <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">SHOP Grid VIEW</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-15.jpg" alt="Banner"></a></div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-14.jpg" alt="Banner"></a></div>
        </div>

    </div>
</div><!-- Page Banner Section End -->

<!-- Product Section Start -->
<div class="product-section section mt-10 mb-90">
    <div class="container">
        <div class="row">


            <div class="col-lg-3 col-12" style="background-color: #fefefe">

                <div class="blog-sidebar mb-5">

                    <h4 class="title"><img src="assets/images/product/settings.png">Personal Care Smart Search</h4>

                    <div class="ee-login">
                        <!-- Filter Form -->
                        <form action="#" style="margin-top: 15px">
                            <div class="row">
                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <input type="text" placeholder="Insert Your Keyword"  style="
                                    font-size: 12px;
                                    border-radius: 5px;
                                    line-height: 20px;
                                    background-color: white;
                                    border: 1px solid #e4e4e4;
                                    width: 92%;
                                    /* margin: auto; */
                                    padding: 10px 9px;">
                                </div>

                                <!------------- Filter By Category -------------->
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal pb-10" style="font-size: 14px">Select Category</h4>
                                    </div>
                                </div>
                                <div class="col-12 mb-15" style="border-bottom: 1px solid #e4e4e4;
                                padding-bottom: 10px;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Eye Care
                                                    <input type="checkbox" checked="checked"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Oral Care
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Skin Care
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Hair Care
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Foot Care
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Nail Care
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <!------------- Custom Fields -------------->
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal pb-10" style="font-size: 14px">Custom Fields</h4>
                                    </div>
                                </div>
                                <div class="col-12" style="border-bottom: 1px solid #e4e4e4; padding-bottom: 10px">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Woman
                                                    <input type="checkbox" checked="checked"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Man
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Babies
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!------------- Filter By Price -------------->
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal mt-3" style="font-size: 14px">Price Range</h4>
                                    </div>
                                </div>
                                <div class="col-12" style="border-bottom: 1px solid #e4e4e4; padding-bottom: 10px">
                                    <div class="container-fluid">
                                        <div class="sidebar-price">
                                            <div id="price-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all"></div><span class="ui-slider-handle ui-state-default ui-corner-all"></span><span class="ui-slider-handle ui-state-default ui-corner-all" ></span></div>
                                            <input type="text" id="price-amount" readonly="">
                                        </div>
                                    </div>
                                </div>


                                <!------------- Filter By Category -------------->
                                <div class="col-12 pt-10">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal pb-10" style="font-size: 14px">Featured Brands</h4>
                                    </div>
                                </div>
                                <div class="col-12 mb-15">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Signal 2
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Oral-B
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Pampers
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Colgate
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Crest
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">Lestrein
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <div class="col-12">
                                    <div class="container-fluid">
                                        <div class="sidebar-price d-flex flex-row justify-content-center">
                                            <input type="submit" value="Filter" class="text-white" style="font-size: 14px; padding: 7px 9px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


            </div>

            <div class="col-lg-9 col-12">

                <div class="row mb-50">
                    <div class="col">

                        <!-- Shop Top Bar Start -->
                        <div class="shop-top-bar">

                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                            </div>

                            <!-- Product Showing -->
                            <div class="product-showing">
                                <p>Showing</p>
                                <select name="showing" class="nice-select">
                                    <option value="1">8</option>
                                    <option value="2">12</option>
                                    <option value="3">16</option>
                                    <option value="4">20</option>
                                    <option value="5">24</option>
                                </select>
                            </div>

                            <!-- Product Short -->
                            <div class="product-short">
                                <p>Sort By</p>
                                <select name="sortby" class="nice-select">
                                    <option value="trending">Brands</option>
                                    <option value="sales">Best sellers</option>
                                    <option value="rating">Best rated</option>
                                    <option value="date">Newest items</option>
                                    <option value="price-asc">Price: low to high</option>
                                    <option value="price-desc">Price: high to low</option>
                                </select>
                            </div>

                            <!-- Product Pages -->
                            <div class="product-pages">
                                <p>Pages 1 of 25</p>
                            </div>

                        </div><!-- Shop Top Bar End -->

                    </div>
                </div>

                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid row">

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">

                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-1.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Laptop</a>
                                    <h5 class="title"><a href="single-product.html">Zeon Zen 4 Pro</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$295.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-1.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Laptop</a>
                                        <h5 class="title"><a href="single-product.html">Zeon Zen 4 Pro</a></h5>
                                    </div>

                                    <h5 class="price">$295.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Intel Core i7 Processor</li>
                                            <li>Zeon Z 170 Pro Motherboad</li>
                                            <li>16 GB RAM</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->

                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-2.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Drone</a>
                                    <h5 class="title"><a href="single-product.html">Aquet Drone D 420</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price"><span class="old">$350</span>$275.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-2.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Drone</a>
                                        <h5 class="title"><a href="single-product.html">Aquet Drone D 420</a></h5>
                                    </div>

                                    <h5 class="price"><span class="old">$350</span>$275.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Diagonal Size 350mm</li>
                                            <li>Max Speed 16m/s (ATTI mode)</li>
                                            <li>Maz Flight Time  Approx. 25min</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-3.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Games</a>
                                    <h5 class="title"><a href="single-product.html">Game Station X 22</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$295.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-3.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Games</a>
                                        <h5 class="title"><a href="single-product.html">Game Station X 22</a></h5>
                                    </div>

                                    <h5 class="price">$295.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Single-chip custom processor</li>
                                            <li>Memory GDDR5 8GB</li>
                                            <li>Game resolution 1080p</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-4.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Accessories</a>
                                    <h5 class="title"><a href="single-product.html">Roxxe Headphone Z 75</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$110.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-4.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Accessories</a>
                                        <h5 class="title"><a href="single-product.html">Roxxe Headphone Z 75</a></h5>
                                    </div>

                                    <h5 class="price">$110.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Bluetooth Version: 4.1</li>
                                            <li>Playback Time: 13 hours</li>
                                            <li>Battery Capacity: 250mAh</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-5.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Camera</a>
                                    <h5 class="title"><a href="single-product.html">Mony Handycam Z 105</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$110.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-5.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Camera</a>
                                        <h5 class="title"><a href="single-product.html">Mony Handycam Z 105</a></h5>
                                    </div>

                                    <h5 class="price">$110.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Full HD Camcorder</li>
                                            <li>Dual Video Recording</li>
                                            <li>X type battery operation</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-6.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Camera</a>
                                    <h5 class="title"><a href="single-product.html">Axor Digital camera</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price"><span class="old">$265</span>$199.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-6.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Camera</a>
                                        <h5 class="title"><a href="single-product.html">Axor Digital camera</a></h5>
                                    </div>

                                    <h5 class="price"><span class="old">$265</span>$199.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>5x optical zoom</li>
                                            <li>26 mm Wide Angle lens</li>
                                            <li>Super HAD CCD 20.1 MP sensor</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-7.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Camera</a>
                                    <h5 class="title"><a href="single-product.html">Silvex DSLR Camera T 32</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$580.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-7.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Camera</a>
                                        <h5 class="title"><a href="single-product.html">Silvex DSLR Camera T 32</a></h5>
                                    </div>

                                    <h5 class="price">$580.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>24 MP CMOS sensor</li>
                                            <li>Vari Angle LCD Monitor </li>
                                            <li>Noise reduction, High Sensitivity</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label new">new</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-8.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Camera</a>
                                    <h5 class="title"><a href="single-product.html">Necta Instant Camera</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$320.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-8.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Camera</a>
                                        <h5 class="title"><a href="single-product.html">Necta Instant Camera</a></h5>
                                    </div>

                                    <h5 class="price">$320.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>10.0 megapixel digital camera</li>
                                            <li>Prints 2x3" full color images</li>
                                            <li>No Ink. No Hassles</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-9.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Watch</a>
                                    <h5 class="title"><a href="single-product.html">Mascut Smart Watch</a></h5>

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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-9.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Watch</a>
                                        <h5 class="title"><a href="single-product.html">Mascut Smart Watch</a></h5>
                                    </div>

                                    <h5 class="price"><span class="old">$365</span>$295.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Amoled 390X390 326 ppi</li>
                                            <li>Andriod Wear 2.0</li>
                                            <li>Built-in GPS</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-10.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Accessories</a>
                                    <h5 class="title"><a href="single-product.html">Z Bluetooth Headphone</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$189.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-10.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Accessories</a>
                                        <h5 class="title"><a href="single-product.html">Z Bluetooth Headphone</a></h5>
                                    </div>

                                    <h5 class="price">$189.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Built-in Microphone</li>
                                            <li>Multi-function keys</li>
                                            <li>Ear Cap</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label new">new</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-11.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Printer</a>
                                    <h5 class="title"><a href="single-product.html">Pranon Photo Printer Y 25</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$210.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-11.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Printer</a>
                                        <h5 class="title"><a href="single-product.html">Pranon Photo Printer Y 25</a></h5>
                                    </div>

                                    <h5 class="price">$210.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Print Resolution 300 dots/inch</li>
                                            <li>Connectivity: WiFi, PictBridge</li>
                                            <li>Maximum Paper size A6</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-12.png" alt="Product Image"></a>

                                <div class="wishlist-compare">
<!--                                     <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Audio</a>
                                    <h5 class="title"><a href="single-product.html">Roses Speaker Box</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">$210.00</h5>
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

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-12.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Audio</a>
                                        <h5 class="title"><a href="single-product.html">Roses Speaker Box</a></h5>
                                    </div>

                                    <h5 class="price">$210.00</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Wireless connectivity </li>
                                            <li>Lightweight, Portable</li>
                                            <li>AUX Function</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>

                </div><!-- Shop Product Wrap End -->

                <div class="row mt-30">
                    <div class="col">

                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-left"></i>Back</a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li> - - - - - </li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">20</a></li>
                            <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                        </ul>

                    </div>
                </div>

            </div>


        </div>
    </div>
</div><!-- Feature Product Section End -->

@include('layouts.brands')

@include('layouts.subscribe')

@endsection
