@extends('layouts.header')
@section('content')

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>@lang('trans.faq')</h1>
                {{--<div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">Faq</a></li>
                    </ul>
                </div>--}}
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-15.jpg" alt="Banner"></a></div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-14.jpg" alt="Banner"></a></div>
        </div>

    </div>
</div><!-- Page Banner Section End -->

<!-- Faq Section Start -->
<div class="faq-section section mt-90 mb-40">
    <div class="container">
        <div class="row row-25">

            <?php
                $i=0;
                //if count(faq)==9
            $f_count = ceil(count($faqs)/2);//ex: 5

            ?>

            <div class="col-lg-6 col-12 mb-50">
                <div class="faq-wrap">
                    @foreach($faqs as $faq)
                    <div class="single-faq">
                        <h4>@if(app()->getLocale() == 'ar'){{$faq->question_ar}}@else{{$faq->question}}@endif</h4>
                        <p>@if(app()->getLocale() == 'ar'){{$faq->answer_ar}}@else{{$faq->answer}}@endif</p>
                    </div>

                        <?php $i++;?>
                        @if($i==$f_count)
                </div>
            </div>
                <div class="col-lg-6 col-12 mb-50">
                    <div class="faq-wrap">
                            @endif
                    @endforeach

                </div>

            </div>



            <div class="col-12 mb-50"><p class="ask-question">Can’t find an answer? Call us at <a href="tel:+88012354569658268">+88012354 569 658 268</a> or mail us through <a href="mailto:info@e&e.com">info@e&e.com</a></p></div>

        </div>
    </div>
</div><!-- Faq Section End -->
@include('layouts.brands')

@include('layouts.subscribe')
@endsection
