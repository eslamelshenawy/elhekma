<?php
if (app()->getLocale() == 'en'){
    $text1 = 'text1';
    $text2 = 'text2';
}else{
    $text1 = 'text1_ar';
    $text2 = 'text2_ar';
}
?>
                <!-- Hero Slider Start -->
                <div class="hero-slider hero-slider-one"  style="background-color:#fdfdfd;">
                        @foreach ($sliders as $slider)

                    <!-- Hero Item Start -->
                    <div class="hero-item">
                        <div class="row align-items-center justify-content-between">

                            <div class="hero-content col">

                                <h2>@lang('trans.hurry_up')!</h2>
                                <h1><span>{{ $slider->$text1 }}</span></h1>
                                <h1> {{--<span class="big">15% </span> --}}{{ $slider->$text2 }}</h1>
                                <a target="blanck_" href="{{ $slider->link }}">@lang('trans.order_now')</a>

                            </div>


                            <div class="hero-image col">
                               <img src="{{ urldecode(URL::to('/uploads',$slider->image))}}" alt="{{$slider->link}}" width="400px" height="250px">
                            </div>

                        </div>
                    </div><!-- Hero Item End -->
                    @endforeach
                </div><!-- Hero Slider End -->
