@extends('layouts.header')
@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.cart')</h1>
                <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        {{--  <li><a href="#">Shop</a></li>  --}}
                        <li><a href="#">@lang('trans.cart')</a></li>
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

<!-- Cart Page Start -->
<div class="page-section section pt-90 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <!-- Cart Table -->
                    <div class="cart-table taEmpty Cartble-responsive mb-40">
                        <?php $total_price = 0; ?>
                        @if( !\App\Models\customer::getCart() )
                            <h3 class="text-center">@lang('trans.empty_cart')</h3>
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">@lang('trans.image')</th>
                                    <th class="pro-title">@lang('trans.product')</th>
                                    <th class="pro-price">@lang('trans.price')</th>
                                    <th class="pro-quantity">@lang('trans.quantity')</th>
                                    <th class="pro-subtotal">@lang('trans.total')</th>
                                    <th class="pro-remove">@lang('trans.remove')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(\App\Models\customer::getCart() as $item)
                                <?php $total_price += $item['quantity_price']; ?>

                                <tr class="cart_row" data-id="{{$item['product_id']}}">
                                    <td class="pro-thumbnail"><a href="{{ route('singleProduct',[ 'id'  => $item['product_id']]) }}"><img src="@if($item['product_image']) {{ urldecode(URL::to('/uploads',$item['product_image']))}} @else assets/images/product/product-1.png @endif" alt="Product"></a></td>
                                    <td class="pro-title"><a href="{{ route('singleProduct',[ 'id'  => $item['product_id']]) }}">
                                            @if(\App::isLocale('en'))
                                            {{$item['product_name']}}
                                            @else
                                            {{$item['product_name_ar']}}
                                            @endif
                                        </a></td>
                                    <td class="pro-price"><span>{{$item['item_price']}}</span></td>
                                    <td class="pro-quantity"><div class="pro-qty"><input class="qty-input" data-id="{{$item['product_id']}}" type="text" value="{{$item['quantity']}}"></div></td>
                                    <td class="pro-subtotal"><span>{{$item['quantity_price']}}</span></td>
                                    <td class="pro-remove" data-id="{{$item['product_id']}}"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>

                                @endforeach
                                {{--<tr>--}}
                                    {{--<td class="pro-thumbnail"><a href="#"><img src="assets/images/product/product-2.png" alt="Product"></a></td>--}}
                                    {{--<td class="pro-title"><a href="#">Aquet Drone D 420</a></td>--}}
                                    {{--<td class="pro-price"><span>$275.00</span></td>--}}
                                    {{--<td class="pro-quantity"><div class="pro-qty"><input type="text" value="2"></div></td>--}}
                                    {{--<td class="pro-subtotal"><span>$550.00</span></td>--}}
                                    {{--<td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="pro-thumbnail"><a href="#"><img src="assets/images/product/product-3.png" alt="Product"></a></td>--}}
                                    {{--<td class="pro-title"><a href="#">Game Station X 22</a></td>--}}
                                    {{--<td class="pro-price"><span>$295.00</span></td>--}}
                                    {{--<td class="pro-quantity"><div class="pro-qty"><input type="text" value="1"></div></td>--}}
                                    {{--<td class="pro-subtotal"><span>$295.00</span></td>--}}
                                    {{--<td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="pro-thumbnail"><a href="#"><img src="assets/images/product/product-4.png" alt="Product"></a></td>--}}
                                    {{--<td class="pro-title"><a href="#">Roxxe Headphone Z 75 </a></td>--}}
                                    {{--<td class="pro-price"><span>$110.00</span></td>--}}
                                    {{--<td class="pro-quantity"><div class="pro-qty"><input type="text" value="1"></div></td>--}}
                                    {{--<td class="pro-subtotal"><span>$110.00</span></td>--}}
                                    {{--<td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>--}}
                                {{--</tr>--}}
                            </tbody>
                        </table>
                        @endif
                    </div>

                </form>

                <div class="row">

                    <div class="col-lg-6 col-12 mb-15">
                        <!-- Calculate Shipping -->
                        {{--<div class="calculate-shipping">
                            <h4>Calculate Shipping</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <select class="nice-select">
                                            <option>Bangladesh</option>
                                            <option>China</option>
                                            <option>country</option>
                                            <option>India</option>
                                            <option>Japan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <select class="nice-select">
                                            <option>Dhaka</option>
                                            <option>Barisal</option>
                                            <option>Khulna</option>
                                            <option>Comilla</option>
                                            <option>Chittagong</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" placeholder="Postcode / Zip">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="Estimate">
                                    </div>
                                </div>
                            </form>
                        </div>--}}
                        <!-- Discount Coupon -->
                        {{--<div class="discount-coupon">
                            <h4>Discount Coupon Code</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="Apply Code">
                                    </div>
                                </div>
                            </form>
                        </div>--}}
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-6 col-12 mb-40 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4>@lang('trans.cart_summery')</h4>
                                <p>@lang('trans.sub_total') <span id="sub_total">{{$total_price}}</span></p>
                                <p>@lang('trans.shipping_cost') <span>{{$shipping_cost}}</span></p>
                                <h2>@lang('trans.grand_total') <span id="grand_total">{{$total_price+$shipping_cost}}</span></h2>
                            </div>
                            <div class="cart-summary-button">
                                <button onclick="window.location.href = '/checkout';" class="checkout-btn">@lang('trans.checkout')</button>
                                {{--<button class="update-btn">Update Cart</button>--}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

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
