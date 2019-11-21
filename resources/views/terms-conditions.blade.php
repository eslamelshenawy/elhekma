@extends('layouts.header')
@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.terms')</h1>
                {{--  <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>  --}}
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.terms')</a></li>
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

<!-- Terms & Conditions Section Start -->
<div class="terms-conditions-section section mt-90 mb-90">
    <div class="container">
        <div class="row">

        @if(isset($current->description))
            @if( app()->getLocale() == 'en')
            {!! $current->description !!}
            @elseif(app()->getLocale() == 'ar')
            {!! $current->description_ar !!}
            @endif
        @endif
        
        </div>
    </div>
</div><!-- Terms & Conditions Section End -->

@include('layouts.brands')

@include('layouts.subscribe')
@endsection
