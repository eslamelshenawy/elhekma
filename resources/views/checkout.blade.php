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
    </style>
@endsection

@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.checkout')</h1>
                {{--<div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Checkout</a></li>
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

<!-- Checkout Page Start -->
<div class="page-section section mt-90 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Checkout Form s-->
                <form action="{{route('submitCheckout')}}" method="post" class="checkout-form">
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

                                       <div id="outlets_status">
                                           @foreach($outlets_status as $status)
                                               <h5>- {{$status['text']}}
                                               @if($status['type'] == 'unavailable')
                                                   <a style="text-decoration: underline" href="{{route('cartPage')}}">update cart</a>
                                               @endif
                                               </h5>
                                           @endforeach
                                       </div>
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

                       <div class="col-lg-5">
                           <div class="row">

                               <!-- Cart Total -->
                               <div class="col-12 mb-60">

                                   <h4 class="checkout-title">@lang('trans.cart_summery')</h4>

                                   <div class="checkout-cart-total">

                                       <h4>@lang('trans.product') <span>@lang('trans.total')</span></h4>

                                       <ul>
                                           @foreach($cart as $item)
                                           <li>
                                               @if(\App::isLocale('en'))
                                               {{$item['product_name']}}
                                               @else
                                               {{$item['product_name_ar']}}
                                               @endif
                                               <span>{{$item['quantity_price']}}</span></li>
                                           @endforeach
                                       </ul>

                                       <p>@lang('trans.sub_total') <span>{{$total_price}}</span></p>
                                       <p>@lang('trans.shipping_cost') <span>{{$shipping_cost}}</span></p>

                                       <h4>@lang('trans.grand_total') <span>{{$total_price + $shipping_cost}}</span></h4>

                                   </div>

                               </div>

                               <!-- Payment Method -->
                               <div class="col-12 mb-60">

                                   <h4 class="checkout-title">@lang('trans.payment_method')</h4>

                                   <div class="checkout-payment-method">

                                       <label id="method_error" style="color:red;" class="d-none">@lang('trans.payment_method_hint')</label>


                                       <div class="single-method">
                                           <input type="radio" id="payment_cash" name="payment-method" value="3">
                                           <label for="payment_cash">@lang('trans.cash_on_delivery')</label>
                                           {{--<p data-method="cash">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>--}}
                                       </div>

                                       <div class="single-method">
                                           <label id="terms_error" style="color:red;" class="d-none">@lang('trans.agree_on_terms_hint')</label>
                                           <input type="checkbox" id="accept_terms">
                                           <label for="accept_terms">@lang('trans.agree_on_terms')</label>
                                       </div>

                                   </div>

                                   <button class="place-order @if($disabled_checkout) disabled @endif" @if($disabled_checkout) disabled @endif >@lang('trans.place_order')</button>

                               </div>

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
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-10.jpg" alt="Banner"></a></div>
            </div>

        </div>
    </div>
</div><!-- Banner Section End -->

@include('layouts.brands')

@include('layouts.subscribe')
@endsection


@section('script_bottom')
    <script src="{{asset('assets/js/checkoutStates.js')}}"></script>
@endsection