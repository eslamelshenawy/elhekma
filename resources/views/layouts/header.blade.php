    <?php

        // $products = \App\Models\products::select('id','name_en')->get();

        $footer = \App\Models\store_identity::first();


    ?>
<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}" @if (app()->getLocale() == 'ar') dir='rtl' @else dir='ltr' @endif>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=charset=iso-8859-6">
    <title>Haithem & Salah Pharmacies</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}} ">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/icon-font.min.css')}} ">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}} ">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styleUpdates.css')}} ">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}} ">

    <!-- Modernizer JS -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
   <script>
    lang = "{{app()->getLocale()}}";
    </script>
    @if(session("registermessage"))
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        #toast-container>.toast-success{
            background: #3B5997;
            background-image: none !important;
        }


    </style>
    @endif
    @if(session("reviewmessage"))
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        #toast-container>.toast-success{
            background: #3B5997;
            background-image: none !important;
        }


    </style>
    @endif
    @yield('script_top')
</head>

<body>


<!-- Header Section Start -->
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-10 mb-10">
                    <!-- Header Links Start -->
                    <div class="header-links">
                        <a href="{{ route('trackOrder') }}"><img src="{{asset('assets/images/icons/car.png')}}" alt="Car Icon"> <span>@lang('trans.track_order') </span></a>
                        <a href="{{ route('storePage') }}"><img src="{{asset('assets/images/icons/marker.png')}}" alt="Car Icon"> <span>@lang('trans.locate_store')</span></a>
                    </div><!-- Header Links End -->
                </div>

                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <!-- Header Advance Search Start -->
                    <div class="header-advance-search"> 
                        <form method="get" action="{{route('search_product')}}">
                       
                            <div class="input"><input type="text" name="search_product" placeholder="@lang('trans.search_product')" id="search_product_header"></div>

                            <div class="submit"><button><i class="icofont icofont-search-alt-1"></i></button></div>
                        </form>

                     </div>
                    <!-- Header Advance Search End -->
                </div>

                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10" style="padding: unset;">
                    <!-- Header Account Links Start -->
                    <div class="header-account-links">

                     @if ( auth('customer')->check())
                     <a href="{{ route('profile') }}"><i class="icofont icofont-user-alt-7"></i> <span>@lang('trans.my_account')</span></a>
                     <a href="{{ route('logout') }}"><i class="icofont icofont-logout"></i> <span>@lang('trans.logout')</span></a>
                     @else
                     <a href="{{ route('register') }}"><i class="icofont icofont-user-alt-7"></i> <span>@lang('trans.register')</span></a>
                     <a href="{{ route('login') }}"><i class="icofont icofont-login"></i> <span>@lang('trans.login')</span></a>
                     @endif

                    @if(app()->getLocale() == 'ar')
                    <a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a></li>
                    @else
                    <a href="{{ url('locale/ar') }}" ><i class="fa fa-language"></i> AR</a></li>
                    @endif




                    </div><!-- Header Account Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{asset('assets/images/logo.png')}}" alt="H & S">
                            <img class="theme-dark" src="{{asset('assets/images/logo-light.png')}}" alt="H & S">
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                    <!-- Main Menu Start -->
                    <div class="main-menu">
                        <nav>


                           <ul>
                                <li class="active"><a href="{{ route('home') }}">@lang('trans.home')</a></li>
                                <!-- <li class="menu-item-has-children"><a href="#"> @lang('trans.medical_articles') </a> -->
                                    <!--<ul class="sub-menu">
                                        <li class="menu-item-has-children"><a href="shop-grid.html">Shop Departments</a>
                                            <ul class="sub-menu">
                                                <li><a href="shop-grid.html">Medical</a></li>
                                                <li><a href="shop-grid.html">Personal Care</a></li>
                                                <li><a href="shop-grid.html">Cosmatiscs</a></li>
                                                <li><a href="shop-grid.html">Babies Care</a></li>
												<li><a href="shop-grid.html">Woman Care</a></li>
                                                <li><a href="shop-grid.html"> Care</a></li>
                                            </ul>


                                        </li>

                                        <li class="menu-item-has-children"><a href="{{ route('singleProduct') }}">Bundles</a>
                                            <ul class="sub-menu">
                                                <li><a href="single-product.html">New Mamy</a></li>
                                                 <li><a href="single-product.html">First Aid</a></li>
                                                  <li><a href="single-product.html">Gifts</a></li>
                                            </ul>
                                        </li>
                                    </ul>-->
                                </li>
                                <li class="menu-item-has-children"><a href="{{ route('aboutUs') }}">@lang('trans.about_us')</a>
                                    <!--<ul class="mega-menu three-column">
                                        <li><a href="#"></a>
                                            <ul>
                                                <li><a href="about-us.html">Your Medical History</a></li>
                                                <li><a href="best-deals.html">Reminder</a></li>
                                                <li><a href="cart.html">Health Reports</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#"></a>
                                            <ul>
                                                <li><a href="compare.html">Allergies Tracker</a></li>
                                                <li><a href="faq.html">Prescription</a></li>
                                                <li><a href="feature.html">Online Doctor</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#"></a>
                                            <ul>
                                                <li><a href="login.html">Order Pharmaciest vist</a></li>
                                                <li><a href="checkout.html">Refill</a></li>
                                            </ul>
                                        </li>
                                    </ul>-->
                                </li>

                               <li><a href="{{ route('prescriptionHistory') }}">@lang('trans.prescriptions')</a></li>
                               <li><a href="{{ route('contactUs') }}">@lang('trans.contact')</a></li>
                            </ul>

                        </nav>
                    </div><!-- Main Menu End -->
                </div>

                <div class="col order-2 order-lg-12 order-xl-12">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">

                        <!-- Compare -->
                        <!-- <a href="{{ route('compare') }}" class="header-compare"><i class="ti-control-shuffle"></i></a> -->
                        <!-- Wishlist -->
                        @if(Auth::guard('customer')->user())
                        <a href="{{ route('wishlist') }}" class="header-wishlist"><i class="ti-heart"></i> <span class="number">
                            {{count(auth('customer')->user()->favorite)}}</span></a>
                        @else
                        <a href="{{ route('wishlist') }}" class="header-wishlist"><i class="ti-heart"></i> <span class="number">0
                            </span></a>                        
                        @endif
                        <!-- Cart -->
                        <a href="{{ route('cartPage') }}" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">
                                {{count(\App\Models\customer::getCart())}}
                            </span></a>

                    </div><!-- Header Shop Links End -->
                </div>
                <!-- Mini Cart Wrap Start -->
                <div class="mini-cart-wrap">

                    <!-- Mini Cart Top -->
                    <div class="mini-cart-top">

                        <button class="close-cart">@lang('trans.close')<i class="icofont icofont-close"></i></button>

                    </div>

                    <div id="cart_content">
                        @include('mini_cart_sidebar')
                    </div>

                </div><!-- Mini Cart Wrap End -->

                <!-- Cart Overlay -->
                <div class="cart-overlay"></div>


                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->

    <!-- Header Category Start -->
    <div class="header-category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col">

                    <!-- Header Category -->
                    <div class="header-category">

                        <!-- Category Toggle Wrap -->
                        <div class="category-toggle-wrap d-block d-lg-none">
                            <!-- Category Toggle -->
                            <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                        </div>

                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul>

                                @foreach($departments as $department)

                                <li>

                                    <div class="dropdown medicine-menu">
                                        <a href="{{route('medicine.Page',$department->name_en)}}" class="dropdown-toggle ">
                                            @if(app()->getLocale() == 'ar')
                                                @if(isset($department->name_ar))
                                                {{$department->name_ar}}
                                                @else
                                                {{$department->name_en}}
                                                @endif                                            
                                            @else
                                            {{$department->name_en}}
                                            @endif
                                           </a>

                                    </div>
                                </li>
                                @endforeach
                                <!---- Makeup ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Makeup
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pregnancy</a>
                                            <a class="dropdown-item" href="shop-grid.html">Psychological & Nervous</a>
                                            <a class="dropdown-item" href="shop-grid.html">Digesitive</a>
                                            <a class="dropdown-item" href="shop-grid.html">Immunity</a>
                                            <a class="dropdown-item" href="shop-grid.html">Allergies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Vitamins</a>
                                            <a class="dropdown-item" href="shop-grid.html">Respiratory</a>
                                            <a class="dropdown-item" href="shop-grid.html">Supplies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Skin</a>
                                            <a class="dropdown-item" href="shop-grid.html">Antibiotics</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pain Killers</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!---- Bath &  Spa ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Perfumes
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pregnancy</a>
                                            <a class="dropdown-item" href="shop-grid.html">Psychological & Nervous</a>
                                            <a class="dropdown-item" href="shop-grid.html">Antibiotics</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pain Killers</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!---- Personal Care ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Personal Care
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pregnancy</a>
                                            <a class="dropdown-item" href="shop-grid.html">Psychological & Nervous</a>
                                            <a class="dropdown-item" href="shop-grid.html">Digesitive</a>
                                            <a class="dropdown-item" href="shop-grid.html">Hormones & Nodes</a>
                                            <a class="dropdown-item" href="shop-grid.html">Immunity</a>
                                            <a class="dropdown-item" href="shop-grid.html">Allergies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Vitamins</a>
                                            <a class="dropdown-item" href="shop-grid.html">Skin</a>
                                            <a class="dropdown-item" href="shop-grid.html">Antibiotics</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pain Killers</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!---- Skin Care ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Nutrition
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pregnancy</a>
                                            <a class="dropdown-item" href="shop-grid.html">Psychological & Nervous</a>
                                            <a class="dropdown-item" href="shop-grid.html">Digesitive</a>
                                            <a class="dropdown-item" href="shop-grid.html">Hormones & Nodes</a>
                                            <a class="dropdown-item" href="shop-grid.html">Immunity</a>
                                            <a class="dropdown-item" href="shop-grid.html">Allergies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Vitamins</a>
                                            <a class="dropdown-item" href="shop-grid.html">Respiratory</a>
                                            <a class="dropdown-item" href="shop-grid.html">Supplies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Skin</a>
                                            <a class="dropdown-item" href="shop-grid.html">Antibiotics</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pain Killers</a>                                        </div>
                                    </div>
                                </li> -->
                                <!---- Hair Care ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Medical Devices
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!---- Home Visit Services ---->
                                <!-- <li>
                                    <div class="dropdown medicine-menu">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Home Visit Services
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                            <a class="dropdown-item" href="shop-grid.html">Heart</a>
                                            <a class="dropdown-item" href="shop-grid.html">Blood</a>
                                            <a class="dropdown-item" href="shop-grid.html">Bones & Muscles</a>
                                            <a class="dropdown-item" href="shop-grid.html">Pregnancy</a>
                                            <a class="dropdown-item" href="shop-grid.html">Psychological & Nervous</a>
                                            <a class="dropdown-item" href="shop-grid.html">Digesitive</a>
                                            <a class="dropdown-item" href="shop-grid.html">Hormones & Nodes</a>
                                            <a class="dropdown-item" href="shop-grid.html">Immunity</a>
                                            <a class="dropdown-item" href="shop-grid.html">Allergies</a>
                                            <a class="dropdown-item" href="shop-grid.html">Vitamins</a>
                                        </div>
                                    </div>
                                </li> -->
                            </ul>
                        </nav>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Header Category End -->

</div><!-- Header Section End -->
@yield('content')



<!-- Footer Section Start -->
<div class="footer-section section bg-ivory">

    <!-- Footer Top Section Start -->
    <div class="footer-top-section section pt-90 pb-50">
        <div class="container">

            <!-- Footer Widget Start -->
            <div class="row">
                <div class="col mb-90">
                    <div class="footer-widget text-center">
                        <div class="footer-logo">
                            <img src="{{asset('assets/images/logo.png')}}" alt="H & S">
                            <img class="theme-dark" src="{{asset('assets/images/logo-light.png')}}" alt="H & S">
                        </div>
                        <p>@lang('trans.pharmacy_desc')</p>
                    </div>
                </div>
            </div><!-- Footer Widget End -->

            <div class="row">

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">@lang('trans.contact_info')</h4>

                        @if($footer && $footer->address)
                        <p class="contact-info">
                            <span>@lang('trans.address')</span>
                            {{$footer->address}}
                        </p>
                        @endif

                        @if($footer && $footer->phone)
                        <p class="contact-info">
                            <span>@lang('trans.phone')</span>
                            <a href="tel:01234567890">{{$footer->phone}}</a>
                        </p>
                        @endif

                        @if($footer && ($footer->address || $footer->website))
                        <p class="contact-info">
                            <span>@lang('trans.web')</span>
                            @if($footer->email)
                            <a href="mailto:{{$footer->email}}">{{$footer->email}}</a>
                            @endif
                            @if($footer->website)
                            <a href="#">{{$footer->website}}</a>
                            @endif
                        </p>
                        @endif
                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">@lang('trans.customer_care') </h4>

                        <ul class="link-widget">
                            <li><a href="{{ route('aboutUs') }}">@lang('trans.about_us')</a></li>
                            @if ( auth('customer')->check())
                            <li><a href="{{ route('profile') }}">@lang('trans.my_account')</a></li>
                            @else
                            <li><a href="{{ route('login') }}">@lang('trans.my_account')</a></li>
                            @endif
                            <li><a href="{{ route('cartPage') }}">@lang('trans.cart')</a></li>
                            <li><a href="{{ route('checkout') }}">@lang('trans.checkout')</a></li>
                            <li><a href="{{ route('trackOrder') }}">@lang('trans.track_order')</a></li>
                            <li><a href="{{ route('wishlist') }}">@lang('trans.wishlist')</a></li>
                            <li><a href="{{ route('prescriptionHistory') }}">@lang('trans.prescriptions')</a></li>
                            {{--<li><a href="#">@lang('trans.blog')</a></li>--}}
                            {{--<li><a href="{{ route('contactUs') }}">@lang('trans.contact')</a></li>--}}
                        </ul>

                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">@lang('trans.information')</h4>

                        <ul class="link-widget">

                            <li><a href="{{ route('storePage') }}">@lang('trans.locate_store')</a></li>
                            <li><a href="{{ route('contactUs') }}">@lang('trans.online_support')</a></li>
                            <li><a href="{{ route('terms') }}">@lang('trans.terms')</a></li>
                            <li><a href="{{ route('page' , 3) }}">@lang('trans.payment')</a></li>
                            <li><a href="{{ route('page' , 4) }}">@lang('trans.shipping_returns')</a></li>
                            <li><a href="{{ route('faq') }}">@lang('trans.faq')</a></li>
                            {{--<li><a href="#">@lang('trans.gift_coupon')</a></li>
                            <li><a href="#">@lang('trans.special_coupon')</a></li>--}}
                        </ul>

                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                {{-- <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">@lang('trans.latest_tweet')</h4>

                        <div class="footer-tweet"></div>

                    </div>
                </div> --}}
                <!-- Footer Widget End -->

            </div>

        </div>
    </div><!-- Footer Bottom Section Start -->

    <!-- Footer Bottom Section Start -->
    <div class="footer-bottom-section section">
        <div class="container">
            <div class="row">

                <!-- Footer Copyright -->
                {{--  <div class="col-lg-6 col-12">
                    <div class="footer-copyright"><p>&copy; Copyright, 2018 All Rights Reserved by <a href="https://freethemescloud.com/">Free themes Cloud</a></p></div>
                </div>  --}}
                <div class="col-lg-6 col-12">
                    <div class="footer-copyright"><p>@lang('trans.copy_right')<a href="#">@lang('trans.point_blank')</a></p></div>
                </div>
                <!-- Footer Payment Support -->
                <div class="col-lg-6 col-12">
                    <div class="footer-payments-image"><img src="{{asset('assets/images/payment-support.png')}}" alt="Payment Support Image"></div>
                </div>

            </div>
        </div>
    </div><!-- Footer Bottom Section Start -->

</div><!-- Footer Section End -->

<!-- Popup Subscribe Section Start -->
<div class="popup-subscribe-section section bg-gray pt-55 pb-55" data-modal="popup-modal">

    <!-- Popup Subscribe Wrap Start -->
    <div class="popup-subscribe-wrap" style="background-color:white">

        <button class="close-popup">X</button>

        <!-- Popup Subscribe Banner -->
        <div class="popup-subscribe-banner banner">
            <a href="#"><img src="{{asset('assets/images/banner/banner-7.jpg')}}" alt="Banner"></a>
        </div>

        <!-- Popup Subscribe Form Wrap Start -->
        <div class="popup-subscribe-form-wrap">

            <h1>SUBSCRIBE <br>OUR NEWSLETTER</h1>
            <h4>Get latest product update...</h4>

            <!-- Newsletter Form -->
            <form action="#" method="post" class="popup-subscribe-form validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <label for="popup_subscribe" class="d-none">Subscribe to our mailing list</label>
                    <input type="email" value="" name="EMAIL" class="email" id="popup_subscribe" placeholder="Enter your email here" required>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                    <button type="submit" name="subscribe" id="" class="button">subscribe</button>
                </div>
            </form>

            <p>Be the first in the by getting special deals and offers send directly to your inbox.</p>

        </div><!-- Popup Subscribe Form Wrap End -->

    </div><!-- Popup Subscribe Wrap End -->

</div><!-- Popup Subscribe Section End -->


<!-- JS
============================================ -->


<!-- jQuery JS -->
<script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- jQuery UI JS -->
<script src="{{asset('assets/js/vendor/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- Plugins JS -->
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<script src="{{asset('assets/js/addToCart.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('assets/js/addFavorite.js')}}"></script>

<script>
    lang = 'en';
    @if(\App::isLocale('ar'))
        lang = 'ar';
    @endif
</script>
<script type="text/javascript">
       $(document).ready(function() {
             $('#search_product_header').on('input',function() {

                var availableProducts=[];
              name_en=$('#search_product_header').val();
                $.ajax({
                         type: "GET",
                            // url: "{{ URL('changelanguage') }}",
                            url:"/auto_complete_products/"+name_en,
                            data: {
                             // "name_en": language,
                            },
                            success: function (response) {
                                for (let index = 0; index < response.length; index++) {
                                    availableProducts.push({label: response[index].name_en, value:  response[index].name_en,id:response[index].id});                                     
                                }
                                $( "#search_product_header" ).autocomplete({
                                    source: availableProducts,
                                      select: function(event,ui) {
                                    var id = ui.item.id;
                                    var url = "{{ route('singleProduct',[ 'id'  => 'idproduct'])}}";
                                    url = url.replace('idproduct', id);
                                    window.location.href = url;                                   
                                    }                                    
                                });

                            },
                            error: function (error) {

                            }
                });
            });
        });

</script>
@yield('script_bottom')
@if(session("registermessage"))
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		$(document).ready(function(){
			toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-bottom-right",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "8000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};
			toastr.success("{{session('registermessage')}}");
		});
	</script>
@endif
@if(session("reviewmessage"))
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "8000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{session('reviewmessage')}}");
        });
    </script>
@endif
</body>

</html>
