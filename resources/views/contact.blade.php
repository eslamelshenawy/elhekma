@extends('layouts.header')
@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.contact')</h1>
                {{--  <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>  --}}
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.contact')</a></li>
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

<!-- Contact Section Start -->
<div class="contact-section section mt-90 mb-40">
    <div class="container">
        <div class="row">

            <!-- Contact Page Title -->
            <div class="contact-page-title col mb-40">
                <h1>@lang('trans.hi_contact')</h1>
            </div>
        </div>
        <div class="row">

            <!-- Contact Tab List -->
            <div class="col-lg-4 col-12 mb-50">
                <ul class="contact-tab-list nav">
                    {{--<li><a class="active" data-toggle="tab" href="#contact-address">Contact us</a></li>--}}
                    <li><a data-toggle="tab" href="#contact-form-tab">@lang('trans.leave_message')</a></li>
                    <li><a data-toggle="tab" href="#store-location">@lang('trans.all_store')</a></li>
                </ul>
            </div>

            <!-- Contact Tab Content -->
            <div class="col-lg-8 col-12">
                <div class="tab-content">

                    <!-- Contact Address Tab -->
                    {{--<div class="tab-pane fade show active row d-flex" id="contact-address">

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Address</h4>
                                <p>You address will be here Lorem Ipsum text</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Phone</h4>
                                <p><a href="tel:01234567890">01234 567 890</a><a href="tel:01234567891">01234 567 891</a></p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Web</h4>
                                <p><a href="mailto:info@example.com">info@example.com</a><a href="#">www.example.com</a></p>
                            </div>
                        </div>

                    </div>--}}
                         @if (session('success_message'))
                         <div class=" alert alert-success">{{session('success_message')}}</div>
                         @endif
                    <!-- Contact Form Tab -->
                    <div class="tab-pane fade row show active d-flex" id="contact-form-tab">
                        <div class="col">

                            <form id="contact-form" action="{{ route('submit.contactUs')}}" method="POST" class="contact-form mb-50">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="first_name">@lang('trans.first_name')*</label>
                                        <input id="first_name" type="text" name="first_name" value="{{ Request::post('first_name') }}">
                                            @if ($errors->has('first_name'))
                                            <div class="badge badge-pill badge-danger">{{ $errors->first('first_name') }}</div>
                                            @endif                                        
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="last_name">@lang('trans.last_name')*</label>
                                        <input id="last_name" type="text" name="last_name" value="{{ Request::post('last_name') }}">
                                            @if ($errors->has('last_name'))
                                            <div class="badge badge-pill badge-danger">{{ $errors->first('last_name') }}</div>
                                            @endif                                           
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="email_address">@lang('trans.email_lable')*</label>
                                        <input id="email_address" type="email" name="email_address" value="{{ Request::post('email_address') }}">
                                            @if ($errors->has('email_address'))
                                            <div class="badge badge-pill badge-danger">{{ $errors->first('email_address') }}</div>
                                            @endif                                           
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="phone_number">@lang('trans.phone')</label>
                                        <input id="phone_number" type="text" name="phone_number" value="{{ Request::post('phone_number') }}">
                                            @if ($errors->has('phone_number'))
                                            <div class="badge badge-pill badge-danger">{{ $errors->first('phone_number') }}</div>
                                            @endif                                           
                                    </div>
                                    <div class="col-12 mb-25">
                                        <label for="message">@lang('trans.message')*</label>
                                        <textarea id="message" name="message" >{{ Request::post('message') }}</textarea>
                                            @if ($errors->has('message'))
                                            <div class="badge badge-pill badge-danger">{{ $errors->first('message') }}</div>
                                            @endif                                           
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" value="@lang('trans.send_now')">
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>

                        </div>
                    </div>

                    <!-- Contact Stores Tab -->
                    <div class="tab-pane fade row d-flex" id="store-location">


                        @foreach($branches as $branch)
                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>@if(app()->getLocale() == 'ar'){{$branch->name_ar}}@else{{$branch->name_en}}@endif</h3>
                                <p>{{$branch->address}}</p>
                                <p><a href="tel:{{$branch->phone}}">{{$branch->phone}}</a></p>
                                <p><a href="mailto:{{$branch->email}}">{{$branch->email}}</a>  / <a href="{{$branch->website}}">{{$branch->website}}</a></p>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Contact Section End -->

@include('layouts.subscribe')
@endsection
