@extends('layouts.header')
@section('content')
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.profile')</h1>

                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.my_account')</a></li>
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

<!-- profiel Section Start -->
<div class="login-section section  mb-90">
    <div class="container">
        <div class="row">
                <div class="col-md-3 col-12 "></div>
                <div class="col-md-6 col-12 ">
                        <div class="ee-login">
                <ul class="list-group">
                        <li class="list-group-item text-muted">@lang('trans.detail') <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item "> <img src="{{ URL::to('/uploads/'.auth('customer')->user()->image) }}" width="150px" height="150px"></li>
                        <li class="list-group-item "><strong>@lang('trans.name'): </strong></span> {{ auth('customer')->user()->full_name }}</li>
                        <li class="list-group-item "><strong>@lang('trans.phone'): </strong></span> {{ auth('customer')->user()->phone_number }}</li>
                        <li class="list-group-item "><strong>@lang('trans.email'): </strong></span> {{ auth('customer')->user()->email }}</li>
                        <li class="list-group-item "><strong>@lang('trans.address'): </strong></span> {{ auth('customer')->user()->address }}</li>
                        <li class="list-group-item "><strong>@lang('trans.state'): </strong></span> {{ auth('customer')->user()->govern['name_en']}}</li>
                        <li class="list-group-item "><strong>@lang('trans.city'): </strong></span> {{ auth('customer')->user()->place['name_en'] }}</li>
                        @if (auth('customer')->user()->zip_code)
                        <li class="list-group-item "><strong>@lang('trans.zip'): </strong></span> {{ auth('customer')->user()->zip_code }}</li>
                        @endif
                        <li class="list-group-item "><strong>@lang('trans.edit_profile'): </strong></span><a href="{{ route('editPage') }}" style="color: darkblue !important;">@lang('trans.click_here')</a></li>

                    </ul>
                        </div>
                </div>
        </div>
    </div>
</div><!-- profile Section End -->

@include('layouts.brands')


@endsection
