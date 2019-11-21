@extends('layouts.header')
@section('content')
    <?php
    $cart = \App\Models\customer::getCart();
    if (app()->getLocale() == 'ar'){
        $name = 'name_ar';
        $description = 'desc_ar';
    }else{
        $name = 'name_en';
        $description = 'desc_en';
    }    
    ?>
<!-- Page Banner Section Start -->
<div  id="favorite_table">
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.wishlist')</h1>
                {{--  <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>  --}}
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        {{--  <li><a href="#">Shop</a></li>  --}}
                        <li><a href="#">@lang('trans.wishlist')</a></li>
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
<div class="page-section section mt-90 mb-90" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">@lang('trans.image')</th>
                                    <th class="pro-title">@lang('trans.product')</th>
                                    <th class="pro-price">@lang('trans.price')</th>
                                    <th class="pro-subtotal">@lang('trans.add_cart')</th>
                                    <th class="pro-remove">@lang('trans.remove')</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @if(Auth::guard('customer')->user())
                                 @foreach(auth('customer')->user()->favorite as $favorite)

                                <tr class="delete_product_{{$favorite->product->id}}">
                                    <td class="pro-thumbnail"><a href="{{ route('singleProduct',[ 'id'  => $favorite->product->id])}}"><img src="{{ urldecode(URL::to('/uploads',$favorite->product->photo))}}" alt="Product"></a></td>
                                    <td class="pro-title"><a href="{{ route('singleProduct',[ 'id'  => $favorite->product->id])}}">
                                    @if(isset($favorite->product->$name))
                                    {{$favorite->product->$name}}
                                    @else
                                    {{$favorite->product->name_en}}
                                    @endif
                                </a></td>
                                    <td class="pro-price"><span>{{$favorite->product->price}}</span></td>
                                @if(!array_key_exists($favorite->product->id, $cart))
                                <td href="#" class="pro-addtocart add-to-cart" data-id="{{$favorite->product->id}}"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></td>
                                @else
                                <td href="#" class="pro-addtocart add-to-cart added" data-id="{{$favorite->product->id}}"><i class="ti-check"></i><span>@lang('trans.added')</span></td>
                                @endif                                    
                                  <!--   <td class="pro-addtocart"><button>@lang('trans.add_cart')</button></td> -->
                                    <td class="pro-remove added" data-id="{{$favorite->product->id}}"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </form>

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
</div>
@include('layouts.brands')
@include('layouts.subscribe')
@endsection
