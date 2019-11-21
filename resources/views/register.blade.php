@extends('layouts.header')
@section('content')
@section('script_top')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <style>
            .design{

                width: 100%;
                background-color: transparent;
                border: 1px solid #999999;
                border-radius: 50px;
                line-height: 23px;
                padding: 10px 20px;
                font-size: 14px;
                height: 45px;
                color: #444444;
                margin-bottom: 15px;


            }
        </style>

@endsection
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.register')</h1>
                {{--  <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>  --}}
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.register')</a></li>
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

<!-- Register Section Start -->
<div class="register-section section mt-90 mb-90">
    <div class="container">
        <div class="row">

            <!-- Register -->
            <div class="col-md-6 col-12 d-flex">
                <div class="ee-register">

                    <h3> @lang('trans.your_register') </h3>
                    <p>E&E provide how all this mistaken idea of denouncing pleasure and sing pain born an will give you a complete account of the system, and expound</p>

                    <!-- Register Form -->
                    <form action="{{ route('submitRegister') }}" method="POST" id="myform" enctype="multipart/form-data" class="checkout-form">
                         @csrf
                         @if (session('message'))
                         <div class=" alert alert-danger">{{session('message')}}</div>
                         @endif
                        <div class="row">
                            <div class="col-6 mb-30"><input type="text" name="full_name" placeholder="@lang('trans.name')" value="@if(old('full_name')) {{ old('full_name') }}@endif" required></div>
                            <div class="col-6 mb-30"><input type="email" name="email" placeholder="@lang('trans.email_lable')" value="@if(old('email')) {{ old('email') }}@endif" required></div>
                            <div class="col-6 mb-30"><input type="text" name="address" placeholder="@lang('trans.address')" value="@if(old('address')) {{ old('address') }}@endif" required></div>
                            <div class="col-6 mb-30"><input type="text" name="phone_number" placeholder="@lang('trans.phone')" value="@if(old('phone_number')) {{ old('phone_number') }}@endif" required></div>
                            {{-- <div class="col-6 mb-30"><input type="text" name="country" placeholder="Your country here" value="@if(old('country')) {{ old('country') }}@endif" required></div> --}}
                            <div class="col-6 mb-30">
                            <select id="state" name="state_id" class="js-example-basic-single design" required>
                                <option value="" selected data-default>@lang('trans.state')</option>
                                @foreach($governs as $govern)
                                    <option value="{{$govern->id}}">{{$govern->name_en}}</option>
                                @endforeach
                            </select>
                             </div>
                             <div class="col-6 mb-30">
                                <select id="city" name="city_id" class="js-example-basic-single design" required >
                                    <option value="" selected data-default>@lang('trans.city')</option>

                                </select>
                                 </div>

                            <div class="col-6 mb-30"><input type="password" name="password" placeholder="@lang('trans.password')" value="@if(old('password')) {{ old('password') }}@endif" required></div>
                            <div class="col-6 mb-30"><input type="password" name="password_confirmation" placeholder="@lang('trans.password_confirmation')" required></div>
                            <div class="col-6 mb-30"><input type="text" name="zip_code" placeholder="@lang('trans.zip')" value="@if(old('zip_code')) {{ old('zip_code') }}@endif"></div>
                            <div class="col-12"><input type="submit" value="@lang('trans.register')"></div>

                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-1 col-12 d-flex">

                <div class="login-reg-vertical-boder"></div>

            </div>

            <!-- Account Image -->
            <div class="col-md-5 col-12 d-flex">

                <div class="ee-account-image">
                    <h3>@lang('trans.upload_image')</h3>

                    <img src="assets/images/account-image-placeholder.jpg" alt="Account Image Placeholder" class="image-placeholder">

                    <div class="account-image-upload">
                        <input form="myform" type="file" name="image" id="account-image-upload"  accept="image/*">
                        <label class="account-image-label" for="account-image-upload">@lang('trans.choose_image')</label>
                    </div>

                    <p>jpeg,png,jpg,gif 250x250</p>

                </div>

            </div>

        </div>
    </div>
</div><!-- Register Section End -->

@include('layouts.brands')

@include('layouts.subscribe')

@endsection
@section('script_bottom')
    {{--  <script src="assets/js/registerPlaces.js"></script>  --}}
   <script>

    $('#state').on('change', function(e){
        var state_select = $('#state');
        var city_select = $('#city');
        var govern = state_select.val();

        $.ajax({
            method: 'GET', // Type of response and matches what we said in the route
            url: "{{  route('places') }}" , // This is the url we gave in the route
            data: {'govern_id' : govern}, // a JSON object to send back
            success: function(response){ // What to do if we succeed

                var selOpts = "";
                for (i=0;i<response.length;i++)
                {
                    var id = response[i]['id'];
                    var val = response[i]['name_en'];
                    selOpts += "<option value='"+id+"'>"+val+"</option>";
                }
                $('#city').empty();
                $('#city').append(selOpts);

            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail

            }


    });
    });
</script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
