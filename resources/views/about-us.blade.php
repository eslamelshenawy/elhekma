@extends('layouts.header')
@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
        </div>

        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@if(isset($current->title))
                        @if( app()->getLocale() == 'en')
                            {!! $current->title !!}
                        @elseif(app()->getLocale() == 'ar')
                            {!! $current->title_ar !!}
                        @endif
                    @endif</h1>
                {{-- <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p> --}}
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>

                        <li><a href="#">@if(isset($current->title))
                                    @if( app()->getLocale() == 'en')
                                        {!! $current->title !!}
                                    @elseif(app()->getLocale() == 'ar')
                                        {!! $current->title_ar !!}
                                    @endif
                                @endif
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{--<!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-15.jpg" alt="Banner"></a></div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-14.jpg" alt="Banner"></a></div>
        </div>--}}

    </div>
</div><!-- Page Banner Section End -->

<!-- About Section Start -->
<div class="about-section section mt-90 mb-30">
    <div class="container">

        @if(isset($current->description))
            @if( app()->getLocale() == 'en')
            {!! $current->description !!}
            @elseif(app()->getLocale() == 'ar')
            {!! $current->description_ar !!}
            @endif
        @endif



        <!-- Mission, Vission & Goal -->
<!--         <div class="about-mission-vission-goal row row-20 mb-40">

            <div class="col-lg-4 col-md-6 col-12 mb-40">
                <h3>OUR VISSION</h3>
                <p>H&S provide how all this mistaken idea of denouncing pleasure and sing pain was born an will give you a ete account of the system, and expound the actual teangs the eat explorer of the truth, the mer of human tas assumenda est, omnis dolor repellend</p>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-40">
                <h3>OUR MISSION</h3>
                <p>H&S provide how all this mistaken idea of denouncing pleasure and sing pain was born an will give you a ete account of the system, and expound the actual teangs the eat explorer of the truth, the mer of human tas assumenda est, omnis dolor repellend</p>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-40">
                <h3>OUR GOAL</h3>
                <p>H&S provide how all this mistaken idea of denouncing pleasure and sing pain was born an will give you a ete account of the system, and expound the actual teangs the eat explorer of the truth, the mer of human tas assumenda est, omnis dolor repellend</p>
            </div>

        </div> -->

        <div class="row mb-30">

            <!-- About Section Title -->
<!--             <div class="about-section-title col-12 mb-50">
                <h3>YOU CAN CHOOSE US BECAUSE <br>WE ALWAYS PROVIDE IMPORTANCE...</h3>
                <p>H&S provide how all this mistaken idea of denouncing pleasure and sing pain was born will give you a complete account of the system, and expound the actual</p>
            </div> -->

            <!-- About Feature -->
<!--             <div class="about-feature col-lg-7 col-12">
                <div class="row">

                    <div class="col-md-6 col-12 mb-30">
                        <h4>FAST DELIVERY</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>QUALITY PRODUCT</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>SECURE PAYMENT</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>MONEY BACK GUARNTEE</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>EASY ORDER TRACKING</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>FREE RETURN</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                    <div class="col-md-6 col-12 mb-30">
                        <h4>24/7 SUPPORT</h4>
                        <p>H&S provide how all this mistaken dea of denouncing pleasure and sing </p>
                    </div>

                </div>
            </div> -->

            <!-- About Feature Banner -->
<!--             <div class="about-feature-banner col-lg-5 col-12 mb-30">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-32.jpg" alt="Banner"></a></div>
            </div> -->

        </div>

    </div>
</div><!-- About Section End -->

@include('layouts.brands')

<!-- Team Section Start -->
<div class="team-section section">
    <div class="col p-0"><img src="assets/images/team/full-team-1.jpg" alt="Full Width Team" style="max-width: 100%;"></div>
</div><!-- Team Section End -->

@include('layouts.subscribe')
@endsection
