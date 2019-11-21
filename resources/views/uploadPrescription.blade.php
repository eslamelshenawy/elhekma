@extends('layouts.header')

@section('script_top')
    <style>
        .place-order.disabled{
            background-color: #c4c3c3;
            color: #FFF;
            cursor: not-allowed;
        }
        #clear_form{
            font-size: 15px;
            font-weight: normal;

            text-decoration: underline;
        }
        #clear_form:hover{
            color:#000;
        }
        #uploadPrescriptionForm .upload-prescription{
            margin-top: 40px;
            width: 140px;
            border-radius: 50px;
            height: 36px;
            border: none;
            line-height: 24px;
            padding: 6px 20px;
            float: left;
            font-weight: 700;
            text-transform: uppercase;
            color: #202020;
            background-color: #75d2de;
        }
    </style>
@endsection

@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.upload_presc')</h1>
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="/assets/images/banner/banner-15.jpg" alt="Banner"></a></div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="/assets/images/banner/banner-14.jpg" alt="Banner"></a></div>
        </div>

    </div>
</div><!-- Page Banner Section End -->

<!-- Checkout Page Start -->
<div class="page-section section mt-90 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Checkout Form s-->
                <form action="{{route('uploadPrescription')}}" method="post" class="checkout-form" id="uploadPrescriptionForm" enctype="multipart/form-data">
                    @csrf
                   <div class="row row-40">

                       <div class="col-lg-7 mb-20">

                           <!-- Shipping Address -->
                           <div id="billing-form" class="mb-40">
                               <h4 class="checkout-title">@lang('trans.shipping_address')</h4>

                               <div class="row">

                                   <div class="col-md-12 col-12 mb-20">
                                       <label @if($errors->has('full_name')) style="color: red;" @endif>@lang('trans.name')*</label>
                                       <input type="text" name="full_name" placeholder="Full Name"
                                              value="@if(old('full_name')) {{ old('full_name') }} @else {{$user->full_name}} @endif">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label @if($errors->has('email')) style="color: red;" @endif>@lang('trans.email')*</label>
                                       <input type="email" name="email" placeholder="Email Address"
                                              value="@if(old('email')) {{ old('email') }} @else {{$user->email}} @endif">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label @if($errors->has('phone')) style="color: red;" @endif>@lang('trans.phone')*</label>
                                       <input type="text" name="phone" placeholder="Phone number"
                                              value="@if(old('phone')) {{ old('phone') }} @else {{$user->phone_number}} @endif">
                                   </div>

                                   <div class="col-12 mb-20">
                                       <label @if($errors->has('address')) style="color: red;" @endif>@lang('trans.address')*</label>
                                       <input type="text" name="address" placeholder="Address"
                                              value="@if(old('address')) {{ old('address') }} @else {{$user->address}} @endif">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label @if($errors->has('govern')) style="color: red;" @endif>@lang('trans.state')*</label>
                                       <select id="govern" name="govern" class="nice-select">
                                           <option selected>-</option>
                                           @foreach($governs as $govern)
                                               <option value="{{$govern->id}}"
                                                   @if($user->state_id == $govern->id) selected @endif
                                               >
                                                   @if(\App::isLocale('en'))
                                                   {{$govern->name_en}}
                                                   @else
                                                   {{$govern->name_ar}}
                                                   @endif
                                               </option>
                                           @endforeach
                                       </select>
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label @if($errors->has('place')) style="color: red;" @endif>@lang('trans.city')*</label>
                                       <select id="place" name="place" class="nice-select" disabled>
                                           <option selected>-</option>
                                           @foreach($governs as $govern)
                                               @foreach($govern->places as $place)
                                                   <option data-gov="{{$govern->id}}" value="{{$place->id}}"
                                                   @if($user->city_id == $place->id) selected @endif
                                                   >
                                                       @if(\App::isLocale('en'))
                                                       {{$place->name_en}}
                                                       @else
                                                       {{$place->name_ar}}
                                                       @endif
                                                   </option>
                                               @endforeach
                                           @endforeach
                                       </select>


                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <a href="#" id="clear_form">@lang('trans.different_address')</a>
                                   </div>


                                   {{--<div class="col-12 mb-20">--}}
                                       {{--<div class="check-box">--}}
                                           {{--<input type="checkbox" id="create_account">--}}
                                           {{--<label for="create_account">Create an Acount?</label>--}}
                                       {{--</div>--}}
                                       {{--<div class="check-box">--}}
                                           {{--<input type="checkbox" id="shiping_address" data-shipping>--}}
                                           {{--<label for="shiping_address">Ship to Different Address</label>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}

                               </div>

                           </div>


                       </div>

                       <div class="col-md-5 col-12 d-flex">

                           <div class="ee-account-image">
                               <h3 @if($errors->has('image')) style="color: red;" @endif>@lang('trans.upload_presc_image')*</h3>

                               <img src="{{ old('image')}}"  class="image-placeholder">

                               <div class="account-image-upload">
                                   <input form="uploadPrescriptionForm" type="file" name="image" id="account-image-upload"   accept="image/*">
                                   <label class="account-image-label" for="account-image-upload" >@lang('trans.choose_image')</label>
                               </div>

                               <p>jpeg,png,jpg,gif 250x250</p>


                               <input type="submit" class="upload-prescription"  value="@lang('trans.upload')" form="uploadPrescriptionForm">

                           </div>


                       </div>

                   </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Checkout Page End -->

<!-- Banner Section Start -->
<div class="banner-section section mb-90">
    <div class="container">
        <div class="row">

            <!-- Banner -->
            <div class="col-12">
                <div class="banner"><a href="#"><img src="/assets/images/banner/banner-10.jpg" alt="Banner"></a></div>
            </div>

        </div>
    </div>
</div><!-- Banner Section End -->

@include('layouts.brands')

@include('layouts.subscribe')
@endsection


@section('script_bottom')
    <script src="{{asset('assets/js/prescriptionStates.js')}}"></script>
@endsection