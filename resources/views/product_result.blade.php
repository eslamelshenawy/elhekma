@extends('layouts.header')

@section('content')
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
            @if($medicineData)   
<div class="product-section section mt-10 mb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="shop-product-wrap grid row" id="medicine_search">
            <div class="shop-top-bar">
                <div class="product-pages">

                <p>@lang('trans.pages') {{$medicineData->currentPage()}} @lang('trans.of') {{$medicineData->lastPage()}}</p>
                </div> 
            </div>
                    @foreach($medicineData as $medicine)
                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">
                                @if($medicine->price_before > $medicine->price && !$medicine->new_arrival)
                                <span class="label sale">@lang('trans.sale')</span>
                                
                                @elseif ($medicine->new_arrival && $medicine->price_before <= $medicine->price)
                                <span class="label new">@lang('trans.new')</span>
                
                                @elseif ($medicine->new_arrival && $medicine->price_before > $medicine->price)
                                <span class="label new">@lang('trans.new_sale')</span>
                                
                                @endif
                                @if($medicine->photo)
                                <a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}" class="img"><img src="{{ urldecode(URL::to('/uploads',$medicine->photo))}}" alt="{{$medicine->$name}}" style="width: 100%;height: 300px;"></a>
                                @else
                                <a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}" class="img"><img src="{{asset('assets/images/product/product-24.png')}}" alt="{{$medicine->$name}}"  style="width: 100%;height: 300px;"></a>                                
                                @endif
                                <div class="wishlist-compare">
                                    <!-- <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a> -->
                                    @if(Auth::guard('customer')->user())
                                        @if( \App\Models\Favorite::where('customer_id', auth('customer')->user()->id)->where('product_id',$medicine->id)->pluck('product_id')->first() == $medicine->id)
                                        <a href="#" class="added" data-id="{{$medicine->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        @else
                                        <a href="#" class="add_to_favorite" data-id="{{$medicine->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        @endif
                                    @else
                                    <a href="#" class="favorite_icon" data-href="{{ route('login')}}" data-id="{{$medicine->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                    @endif
                                </div>

                                @if(!array_key_exists($medicine->id, $cart))
                                <a href="#" class="add-to-cart" data-id="{{$medicine->id}}"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>
                                @else
                                <a href="#" class="add-to-cart added" data-id="{{$medicine->id}}"><i class="ti-check"></i><span>@lang('trans.added')</span></a>
                                @endif

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">
                                    @if(isset($medicine->category->$name))
                                    {{ $medicine->category->$name }}
                                    @else
                                    {{ $medicine->category->name_en }}
                                    @endif                                     
                                    </a>
                                    <h5 class="title"><a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}">
                                    @if(isset($medicine->$name))
                                    {{ str_limit($medicine->$name, $limit = 20, $end = '...')}}
                                    @else
                                    {{ str_limit($medicine->name_en, $limit = 20, $end = '...')}}
                                    @endif 
                                </a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">
                                    @if($medicine->price_before > $medicine->price)
                                    <span class="old">{{$medicine->price_before}}</span>
                                    @endif

                                    {{$medicine->price}}@lang('trans.egp')

                                    </h5>
                                    <div class="ratting">
                            @if(isset($medicine->rating))
                                        <span>({{$medicine->rating}})</span>
                                        @foreach(range(1,5) as $i)


                                                @if($medicine->rating >0)
                                                    @if($medicine->rating >0.5)
                                                        <i class="fa fa-star "></i>
                                                    @else
                                                        <i class="fa fa-star-half "></i>
                                                    @endif
                                                @endif
                                                @php $medicine->rating--; @endphp
                                            </span>
                                        @endforeach  
                            @endif
                                    </div>

                                </div>

                            </div>

                        </div><!-- Product End -->

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">
                                @if($medicine->price_before > $medicine->price && !$medicine->new_arrival)
                                <span class="label sale">@lang('trans.sale')</span>
                                
                                @elseif ($medicine->new_arrival && $medicine->price_before <= $medicine->price)
                                <span class="label new">@lang('trans.new')</span>
                
                                @elseif ($medicine->new_arrival && $medicine->price_before > $medicine->price)
                                <span class="label new">@lang('trans.new_sale')</span>
                                
                                @endif
                                
                                @if($medicine->photo)
                                <a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}" class="img"><img src="{{ urldecode(URL::to('/uploads',$medicine->photo))}}" alt="{{$medicine->$name}}" style="width: 100%;height: 300px;"></a>
                                @else
                                <a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}" class="img"><img src="{{asset('assets/images/product/product-24.png')}}" alt="{{$medicine->$name}}"  style="width: 100%;height: 300px;"></a>                                
                                @endif

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">
                                    @if(isset($medicine->category->$name))
                                    {{ $medicine->category->$name }}
                                    @else
                                    {{ $medicine->category->name_en }}
                                    @endif                                             
                                        </a>
                                        <h5 class="title"><a href="{{ route('singleProduct',[ 'id'  => $medicine->id])}}">
                                    @if(isset($medicine->$name))
                                    {{ str_limit($medicine->$name, $limit = 20, $end = '...')}}
                                    @else
                                    {{ str_limit($medicine->name_en, $limit = 20, $end = '...')}}
                                    @endif 
                                        </a></h5>
                                    </div>
                                    <h5 class="price">
                                    @if($medicine->price_before > $medicine->price)
                                    <span class="old">{{$medicine->price_before}}</span>
                                    @endif
                                    {{$medicine->price}}@lang('trans.egp')

                                    </h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                            @if(isset($medicine->rating))
                                        @if($medicine->rating < 0)
                                        <span>({{$medicine->rating = 5 + $medicine->rating}})</span>
                                        @else
                                        <span>({{$medicine->rating = 5 - $medicine->rating}})</span>
                                        @endif
                                        @foreach(range(1,5) as $i)


                                                @if($medicine->rating >0)
                                                    @if($medicine->rating >0.5)
                                                        <i class="fa fa-star "></i>
                                                    @else
                                                        <i class="fa fa-star-half "></i>
                                                    @endif
                                                @endif
                                                @php $medicine->rating--; @endphp
                                            </span>
                                        @endforeach  
                            @endif
                                    </div>

                                    <div class="desc">
                                        <p>
                                        @if(isset($medicine->$description))
                                        {{ $medicine->$description }}
                                        @else
                                        {{ $medicine->desc_en }}
                                        @endif 
                                        </p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>

                                        <div class="wishlist-compare">
<!--                                             <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
 -->                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>@lang('trans.specifications')</h5>
                                        <ul>
                                            @if(isset($medicine->pharma_tag1_id))
                                            <li>
                                                @if(isset($medicine->pharma_tag1->$name))
                                                {{ $medicine->pharma_tag1->$name }}
                                                @else
                                                {{ $medicine->pharma_tag1->name_en }}
                                                @endif
                                            </li>
                                            @endif
                                            @if(isset($medicine->pharma_tag2_id))
                                            <li>
                                                @if(isset($medicine->pharma_tag2->$name))
                                                {{ $medicine->pharma_tag2->$name }}
                                                @else
                                                {{ $medicine->pharma_tag2->name_en }}
                                                @endif                                                
                                            </li>
                                            @endif
                                            @if(isset($medicine->pharma_tag3_id))
                                            <li>
                                                @if(isset($medicine->pharma_tag3->$name))
                                                {{ $medicine->pharma_tag3->$name }}
                                                @else
                                                {{ $medicine->pharma_tag3->name_en }}
                                                @endif
                                            </li>
                                            @endif                                         
                                        </ul>
                                    </div>
                                    @php
                                    $stock =0;
                                    foreach($medicine->productdetails as $q){
                                        $stock = $stock + $q['quantity'];
                                    }
                                    @endphp
                                    
                                    <span class="availability">@lang('trans.availability'): <span>
                                     @php
                                     if($stock > 0){
                                         if(app()->getlocale() == 'en'){
                                            echo "In Stock"; 
                                         }else{
                                            echo "متوفر";
                                         }
                                     }else{
                                        if(app()->getlocale() == 'en'){
                                            echo "Not Avilable";  
                                         }else{
                                            echo "غير متوفر";
                                         }
                                        
                                        }
                                     @endphp</span></span>
                                    
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>
                    @endforeach
                <div class="row mt-10">
                    <div class="col">

                        <ul class="pagination" style="padding-left:406px; ">
                            
                            {{ $medicineData->links()  }}
                            
                        </ul>

                    </div>
                </div>
                </div><!-- Shop Product Wrap End -->



            </div>


        </div>
    </div>
</div>          
             
@endif
@include('layouts.brands')

@include('layouts.subscribe')
@endsection