<?php
$cart = \App\Models\customer::getCart();
if (app()->getLocale() == 'en'){
    $name = 'name_en';
    $description = 'desc_en';
}else{
    $name = 'name_ar';
    $description = 'desc_ar';
}
?>
@if ($best_sellers)

@foreach ($best_sellers as $product)

<div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
    <!-- Product Start -->
    <div class="ee-product">

        <!-- Image -->
        <div class="image">
            @if($product->price_before > $product->price && !$product->new_arrival)
            <span class="label sale">@lang('trans.sale')</span>
            
            @elseif ($product->new_arrival && $product->price_before <= $product->price)
            <span class="label new">@lang('trans.new')</span>

            @elseif ($product->new_arrival && $product->price_before > $product->price)
            <span class="label new">@lang('trans.new_sale')</span>
            
            @endif
                @if($product->photo)
                <a href="{{ route('singleProduct',[ 'id'  => $product->id])}}" class="img"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="{{$product->$name}}" style="width: 100%;height: 300px;"></a>
                @else
                <a href="{{ route('singleProduct',[ 'id'  => $product->id])}}" class="img"><img src="{{asset('assets/images/product/product-24.png')}}" alt="{{$product->$name}}"  style="width: 100%;height: 300px;"></a>
                @endif
                <div class="wishlist-compare">
                    <!-- <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a> -->
                    @if(Auth::guard('customer')->user())
                        @if( \App\Models\Favorite::where('customer_id', auth('customer')->user()->id)->where('product_id',$product->id)->pluck('product_id')->first() == $product->id)
                        <a href="#" class="added" data-id="{{$product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                        @else
                        <a href="#" class="add_to_favorite" data-id="{{$product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                        @endif
                    @else
                    <a href="#" class="favorite_icon" data-href="{{ route('login')}}" data-id="{{$product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                    @endif
                </div>

                @if(!array_key_exists($product->id, $cart))
                <a href="#" class="add-to-cart" data-id="{{$product->id}}"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>
                @else
                <a href="#" class="add-to-cart added" data-id="{{$product->id}}"><i class="ti-check"></i><span>@lang('trans.added')</span></a>
                @endif

            </div>

        <!-- Content -->
        <div class="content">

            <!-- Category & Title -->
            <div class="category-title">

                    <a href="#" class="cat">
                            @if(isset($product->category->$name))
                            {{ str_limit($product->category->$name, $limit = 30, $end = '...') }}
                            @else
                            {{ str_limit($product->category->name_en, $limit = 30, $end = '...') }}
                            @endif
                            </a>
                            <h5 class="title"><a href="{{ route('singleProduct',[ 'id'  => $product->id])}}">
                            @if(isset($product->$name))
                            {{ str_limit($product->$name, $limit = 20, $end = '...')}}
                            @else
                            {{ str_limit($product->name_en, $limit = 20, $end = '...')}}
                            @endif
                        </a></h5>
            </div>

            <!-- Price & Ratting -->
            <div class="price-ratting">


                    <h5 class="price">
                            @if($product->price_before > $product->price)
                            <span class="old">{{$product->price_before}}</span>
                            @endif

                            {{$product->price}}@lang('trans.egp')

                            </h5>
                            <div class="ratting">
                    @if(isset($product->rating))
                                <span>({{$product->rating}})</span>
                                @foreach(range(1,5) as $i)


                                        @if($product->rating >0)
                                            @if($product->rating >0.5)
                                                <i class="fa fa-star "></i>
                                            @else
                                                <i class="fa fa-star-half "></i>
                                            @endif
                                        @endif
                                        @php $product->rating--; @endphp
                                    </span>
                                @endforeach
                    @endif
                            </div>

            </div>

        </div>

    </div><!-- Product End -->
</div>
@endforeach
@endif

