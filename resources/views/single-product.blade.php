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

<style type="text/css">
div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\2605';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\2605';
}
</style>
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1> @lang('trans.product_details') </h1>
            </div>
        </div>

        <!-- Banner -->


    </div>
</div><!-- Page Banner Section End -->

<!-- Single Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">

        <div class="row mb-90">

            <div class="col-lg-6 col-12 mb-50">

                <!-- Image -->

                @if($product->photo && !empty($images))
                    <?php $count_img = count($images);?>
                <div class="single-product-image thumb-right">
                    <div class="tab-content">

                        <div id="single-image-1" class="tab-pane fade  show active  big-image-slider">
                           <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="{{$product->$name}}"><a href="{{ urldecode(URL::to('/uploads',$product->photo))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            @foreach($images as $img )
                            <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$img))}}" alt="Big Image1"><a href="{{ urldecode(URL::to('/uploads',$img))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                                @endforeach
                        </div>

                           @for($i=0 ; $i<$count_img; $i++)
                               <div id="single-image-{{$i+2}}" class="tab-pane fade big-image-slider">
                                   @foreach($images as $img )
                                       <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$images[$i]))}}" alt="Big Image1"><a href="{{ urldecode(URL::to('/uploads',$images[$i]))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                                   @endforeach
                                   <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="{{$product->$name}}"><a href="{{ urldecode(URL::to('/uploads',$product->photo))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                               </div>
                           @endfor

                        {{--<div id="single-image-2" class="tab-pane fade big-image-slider">
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[0])}}" alt="Big Image4"><a href="{{ urldecode(URL::to('/uploads',$product->photo))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="Big Image5"><a href="{{ URL::to('/uploads',$images[0])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[1])}}" alt="Big Image6"><a href="{{ URL::to('/uploads',$images[1])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[2])}}" alt="Big Image7"><a href="{{ URL::to('/uploads',$images[2])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-image-3" class="tab-pane fade big-image-slider">
                           <div class="big-image"><img src="{{ URL::to('/uploads',$images[1])}}" alt="Big Image8"><a href="{{ URL::to('/uploads',$images[0])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[2])}}" alt="Big Image9"><a href="{{ urldecode(URL::to('/uploads',$product->photo))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="Big Image12"><a href="{{ URL::to('/uploads',$images[2])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[0])}}" alt="Big Image13"><a href="{{ URL::to('/uploads',$images[1])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-image-4" class="tab-pane fade big-image-slider">
                           <div class="big-image"><img src="{{ URL::to('/uploads',$images[2])}}" alt="Big Image14"><a href="{{ urldecode(URL::to('/uploads',$product->photo))}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="Big Image15"><a href="{{ URL::to('/uploads',$images[0])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[0])}}" alt="Big Image16"><a href="{{ URL::to('/uploads',$images[1])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                            <div class="big-image"><img src="{{ URL::to('/uploads',$images[1])}}" alt="Big Image17"><a href="{{ URL::to('/uploads',$images[2])}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>--}}
                    </div>
                    <div class="thumb-image-slider nav" data-vertical="true">
                        <a class="thumb-image active" data-toggle="tab" href="#single-image-1"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="Thumbnail Image"></a>
                        <?php $x=1;?>
                        @foreach($images as $img )
                            <?php $x++;?>
                        <a class="thumb-image" data-toggle="tab" href="#single-image-{{$x}}"><img src="{{ urldecode(URL::to('/uploads',$img))}}" alt="Thumbnail Image"></a>
                       @endforeach
                       {{-- <a class="thumb-image" data-toggle="tab" href="#single-image-3"><img src="{{ URL::to('/uploads',$images[1])}}" alt="Thumbnail Image"></a>
                        <a class="thumb-image" data-toggle="tab" href="#single-image-4"><img src="{{ URL::to('/uploads',$images[2])}}" alt="Thumbnail Image"></a>--}}
                    </div>

                </div>
                @elseif($product->photo && empty($images))
                <div class="single-product-image thumb-right">
                    <div class="tab-content">
                        <div id="single-image-1" class="tab-pane fade show active big-image-slider">
                            <div class="big-image"><img src="{{ urldecode(URL::to('/uploads',$product->photo))}}" alt="Big Image11"></div>

                        </div>
                    </div>


                </div>
                @else
                <div class="single-product-image thumb-right">
                    <div class="tab-content">
                        <div id="single-image-1" class="tab-pane fade show active big-image-slider">
                            <div class="big-image"><img src="{{asset('assets/images/product/product-24.png')}}" alt="Big Image22"></i></div>

                        </div>
                    </div>


                </div>
                @endif

            </div>

            <div class="col-lg-6 col-12 mb-50">

                <!-- Content -->
                <div class="single-product-content">

                    <!-- Category & Title -->
                    <div class="head-content">

                        <div class="category-title">
                            <a href="#" class="cat">{!! $product->category->$name !!}</a>
                            <h5 class="title">{{ $product->$name }}</h5>
                        </div>

                        <h5 class="price">{{$product->price}} @lang('trans.egp')</h5>

                    </div>

                    <div class="single-product-description">

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

                        <div class="desc">
                            <p>{{$product->$description}}</p>
                        </div>
                        @if($stock > 0)
                        <span class="availability">@lang('trans.availability'): <span>@lang('trans.inStock')</span></span>
                        @else
                        <span class="availability">@lang('trans.availability'): <span>@lang('trans.not_available')</span></span>
                        @endif


                        <div class="quantity-colors">

                            <div class="quantity">
                                <h5> @lang('trans.quantity') </h5>
                                @if(!array_key_exists($product->id, $cart))
                                <div class="pro-qty"><input data-id=""  type="text" value="1"></div>
                                @else
                                <div class="pro-qty"><input data-id="{{$cart[$product->id]['product_id']}}" type="text" value="{{$cart[$product->id]['quantity']}}"></div>
                                @endif
                            </div>
                            @if(isset($product->color_id))
                            <div class="colors">
                                <h5>Color</h5>
                                <select class="nice-select">

                                    <option>{{$product->color->name}}</option>

                                </select>
                            </div>
                            @endif

                        </div>

                        <div class="actions">

                            @if(!array_key_exists($product->id, $cart))
                                <a href="#" class="add-to-cart" data-id="{{$product->id}}"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>
                            @else
                                <a href="#" class="add-to-cart added" data-id="{{$product->id}}"><i class="ti-check"></i><span>@lang('trans.added')</span></a>
                            @endif

                            <div class="wishlist-compare">
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

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-10 col-12 ml-auto mr-auto">

                <ul class="single-product-tab-list nav">
                    <li><a href="#product-description" class="active" data-toggle="tab" >@lang('trans.description')</a></li>
                    <li><a href="#product-specifications" data-toggle="tab" >@lang('trans.specifications')</a></li>
                    <li><a href="#product-reviews" data-toggle="tab" >@lang('trans.reviews')</a></li>
                </ul>

                <div class="single-product-tab-content tab-content">
                    <div class="tab-pane fade show active" id="product-description">

                        <div class="row">
                            <div class="single-product-description-content col-lg-8 col-12">
                                <ul>
                                    <li>-<b>@lang('trans.description') :</b> {{$product->$description}}</li>
                                    <li>-<b>@lang('trans.pack_details') :</b> {{$product->pack_details}}</li>
                                    <li>-<b>@lang('trans.target_audience') :</b> {{$product->target_audience->$name}}</li>
                                </ul>


                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="product-specifications">
                        <div class="single-product-specification">
                            <ul>
                                <b>@lang('trans.material')</b>
                                @foreach($product->product_effective_material as $specification)
                                <li>{{ $specification->$name}}</li>
                                @endforeach
                            </ul>
                        <div class="tags">

                            <h5>@lang('trans.tags'):</h5>
                            @if(isset($product->category_id))
                            <li>{{ $product->category->$name }}</li>

                            @endif
                            @if(isset($product->pharma_tag1_id))
                            <li>{{ $product->pharma_tag1->$name }}</li>

                            @endif
                            @if(isset($product->pharma_tag2_id))
                            <li>{{ $product->pharma_tag2->$name }}</li>

                            @endif
                            @if(isset($product->pharma_tag3_id))
                            <li>{{ $product->pharma_tag3->$name }}</li>
                            @endif




                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-reviews">

                        <div class="product-ratting-wrap">
							<div class="pro-avg-ratting">
                                @if($product->rating < 0)
								<h4>{{ $product->rating + 5 }}<span>(@lang('trans.overall'))</span></h4>
                                @else
                                <h4>{{ $product->rating }}<span>(@lang('trans.overall'))</span></h4>
                                @endif
							</div>
							<div class="rattings-wrapper">
                                @foreach($reviews as $review)
                                    @if($review->is_approved == 1)
        								<div class="sin-rattings">
        									<div class="ratting-author">
        										<h3>{{ $review->customer->full_name }}</h3>
                                                <div class="ratting-star">
                                                <span>({{$review->rating}})</span>
                                                @foreach(range(1,5) as $i)
                                                       @if($review->rating >0)
                                                            @if($review->rating >0.5)
                                                                <i class="fa fa-star "></i>
                                                            @else
                                                                <i class="fa fa-star-half "></i>
                                                            @endif
                                                        @endif
                                                        @php $review->rating--; @endphp
                                                    </span>
                                                @endforeach
                                                </div>
        									</div>
        									<p>{{ $review->review }}</p>
        								</div>
                                    @endif
                                @endforeach
							</div>
							<div class="ratting-form-wrapper fix">
                                @if($can_review)
                                @if($current_product->product_id <> $product->id)
                                    <h3>(@lang('trans.add_comment'))</h3>
                                    <div class="ratting-form row">
                                        <div class="col-12 mb-15">
                                            <h5>@lang('trans.rating'):</h5>
                                            <div class="stars">
                                                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                                <label class="star star-1" for="star-1"></label>
                                            </div>
                                            @if ($errors->has('star'))
                                            <div class="alert alert-danger">{{ $errors->first('star') }}</div>
                                          @endif
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="your-review">@lang('trans.your_review'):</label>
                                            <textarea name="review" id="your-review" placeholder="@lang('trans.write_review')"></textarea>
                                            @if ($errors->has('review'))
                                            <div class="alert alert-danger">{{ $errors->first('review') }}</div>
                                          @endif
                                        </div>
                                        <div class="col-12">
                                            <input value="@lang('trans.add_review')" type="submit" class="product_not_buy">
                                        </div>
                                    </div>

                                @endif
                                @if($current_product->product_id == $product->id)
                                @if(empty(App\Models\Review::where('product_id',$product->id)->where('customer_id',auth('customer')->user()->id)->first()))
                                <h3>@lang('trans.add_comment')</h3>
								<form method="post" action="{{ route('addReview') }}" >
                                    @csrf()
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="customer_id" value="{{auth('customer')->user()->id}}">
								    <div class="ratting-form row">
										<div class="col-12 mb-15">
											<h5>@lang('trans.rating'):</h5>
                                            <div class="stars">
                                                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                                <label class="star star-1" for="star-1"></label>
                                            </div>
                                            @if ($errors->has('star'))
                                            <div class="alert alert-danger">{{ $errors->first('star') }}</div>
                                          @endif
										</div>
										<div class="col-12 mb-15">
											<label for="your-review">@lang('trans.review'):</label>
											<textarea name="review" id="your-review" placeholder="@lang('trans.write_review')"></textarea>
                                            @if ($errors->has('review'))
                                            <div class="alert alert-danger">{{ $errors->first('review') }}</div>
                                          @endif
										</div>
										<div class="col-12">
											<input value="@lang('trans.add_review')" type="submit">
										</div>
								    </div>
								</form>
                                @endif
                                @endif
                                @else
                                    <h3>Add your Comments</h3>
                                    <div class="ratting-form row">
                                        <div class="col-12 mb-15">
                                            <h5>Rating:</h5>
                                            <div class="stars">
                                                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                                <label class="star star-1" for="star-1"></label>
                                            </div>
                                            @if ($errors->has('star'))
                                            <div class="alert alert-danger">{{ $errors->first('star') }}</div>
                                          @endif
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="your-review">Your Review:</label>
                                            <textarea name="review" id="your-review" placeholder="Write a review"></textarea>
                                            @if ($errors->has('review'))
                                            <div class="alert alert-danger">{{ $errors->first('review') }}</div>
                                          @endif
                                        </div>
                                        <div class="col-12">
                                            <input value="add review" type="submit" class="product_not_buy">
                                        </div>
                                    </div>
                                @endif
							</div>
						</div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div><!-- Single Product Section End -->

<!-- Related Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                    {{-- data-title="@lang('trans.related_product')" --}}
                <div class="section-title-one" ><h1>@lang('trans.related_product')</h1></div>
            </div><!-- Section Title End -->

            <!-- Product Tab Content Start -->
            <div class="col-12" style='direction:ltr;'>

                <!-- Product Slider Wrap Start -->
                <div class="product-slider-wrap product-slider-arrow-one">
                    <!-- Product Slider Start -->
                    <div class="product-slider product-slider-4">
@foreach($related_products as $related_product)
                        <div class="col pb-20 pt-10">
                            <!-- Product Start -->

                            <div class="ee-product">

                                <!-- Image -->
                                <div class="image">

                                    <a href="{{ route('singleProduct',[ 'id'  => $related_product->id]) }}" class="img">
                                        @if($related_product->price_before > $related_product->price && !$related_product->new_arrival)
                                        <span class="label sale">@lang('trans.sale')</span>
                                        
                                        @elseif ($related_product->new_arrival && $related_product->price_before <= $related_product->price)
                                        <span class="label new">@lang('trans.new')</span>
                        
                                        @elseif ($related_product->new_arrival && $related_product->price_before > $related_product->price)
                                        <span class="label new">@lang('trans.new_sale')</span>
                                        
                                        @endif
                                @if($related_product->photo)
                                <a href="{{ route('singleProduct',[ 'id'  => $related_product->id])}}" class="img"><img src="{{ urldecode(URL::to('/uploads',$related_product->photo))}}" alt="{{$related_product->$name}}" style="width: 100%;height: 300px;"></a>
                                @else
                                <a href="{{ route('singleProduct',[ 'id'  => $related_product->id])}}" class="img"><img src="{{asset('assets/images/product/product-1.png')}}" alt="{{$related_product->$name}}"  style="width: 100%;height: 300px;"></a>
                                @endif
                                <div class="wishlist-compare">
                                    <!-- <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a> -->
                                    @if(Auth::guard('customer')->user())
                                        @if( \App\Models\Favorite::where('customer_id', auth('customer')->user()->id)->where('product_id',$related_product->id)->pluck('product_id')->first() == $related_product->id)
                                        <a href="#" class="added" data-id="{{$related_product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        @else
                                        <a href="#" class="add_to_favorite" data-id="{{$related_product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        @endif
                                    @else
                                    <a href="#" class="favorite_icon" data-href="{{ route('login')}}" data-id="{{$related_product->id}}" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                    @endif
                                </div>

                                @if(!array_key_exists($related_product->id, $cart))
                                <a href="#" class="add-to-cart" data-id="{{$related_product->id}}"><i class="ti-shopping-cart"></i><span>@lang('trans.add_cart')</span></a>
                                @else
                                <a href="#" class="add-to-cart added" data-id="{{$related_product->id}}"><i class="ti-check"></i><span>@lang('trans.added')</span></a>
                                @endif

                                </div>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">{{ $related_product->category->$name }}</a>
                                    <h5 class="title"><a href="{{ route('singleProduct',[ 'id'  => $related_product->id])}}">{{ str_limit($related_product->$name, $limit = 20, $end = '...')}}</a></h5>

                                </div>

                                    <!-- Price & Ratting -->
                                    <div class="price-ratting">

                                        <h5 class="price">{{$related_product->price}} @lang('trans.egp')</h5>
                                        <div class="ratting">
                            @if(isset($related_product->rating))
                                        <span>({{$related_product->rating}})</span>
                                        @foreach(range(1,5) as $i)


                                                @if($related_product->rating >0)
                                                    @if($related_product->rating >0.5)
                                                        <i class="fa fa-star "></i>
                                                    @else
                                                        <i class="fa fa-star-half "></i>
                                                    @endif
                                                @endif
                                                @php $related_product->rating--; @endphp
                                            </span>
                                        @endforeach
                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div><!-- Product End -->

                        </div>
                @endforeach
                    </div><!-- Product Slider End -->
                </div><!-- Product Slider Wrap End -->

            </div><!-- Product Tab Content End -->

        </div>
    </div>
</div><!-- Related Product Section End -->

@include('layouts.brands')

@include('layouts.subscribe')
@endsection

@section('script_bottom')
    <script type="text/javascript">
        $(document).ready(function() {
            $("form#ratingForm").submit(function(e)
            {
                e.preventDefault(); // prevent the default click action from being performed
                if ($("#ratingForm :radio:checked").length == 0) {
                    $('#status').html("nothing checked");
                    return false;
                } else {
                    $('#status').html( 'You picked ' + $('input:radio[name=rating]:checked').val() );
                }
            });
        });
    </script>
@endsection
