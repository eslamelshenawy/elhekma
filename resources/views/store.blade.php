@extends('layouts.header')
@section('content')
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.locate_store')</h1>
                {{--<p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>--}}
               {{-- <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">Locate Store</a></li>
                    </ul>
                </div>--}}
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

<!-- Store Section Start -->
<div class="store-section section mt-90 mb-20">
    <div class="container">
        <div class="row">

            <!-- Single Store -->
            @foreach($branches as $branch)
                <div class="col-lg-4 col-md-6 col-12 mb-70">
                    <div class="single-store">
                        <h3>@if(app()->getLocale() == 'ar'){{$branch->name_ar}}@else{{$branch->name_en}}@endif</h3>
                        <p>{{$branch->address}}</p>
                        <p><a href="tel:{{$branch->phone}}">{{$branch->phone}}</a></p>
                        @if($branch->email)
                        <p><a href="mailto:{{$branch->email}}">{{$branch->email}}</a> </p>
                        @endif
                        @if($branch->website)
                        <p><a href="{{$branch->website}}" target="_blank">{{$branch->website}}</a> </p>
                            @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div><!-- Store Section End -->

<!-- Banner Section Start -->
<div class="banner-section section mb-90">
    <div class="container">
        <div class="row">

          {{--  <!-- Banner -->
            <div class="col-12">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-10.jpg" alt="Banner"></a></div>
            </div>--}}

        </div>
    </div>
</div><!-- Banner Section End -->

@include('layouts.brands')

@include('layouts.subscribe')

@endsection
