@extends('layouts.header')


@section('script_top')


    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <style>
        .page-item .page-link{
            display: inline;
            line-height: 35px;
            border-radius: unset;
        }
        #new_presc_link{
            margin: 20px auto;
        }
        #new_presc_link{
            -webkit-transition: none ;
            -moz-transition: none ;
            -ms-transition: none ;
            -o-transition: none ;
            transition: none ;
        }
        #new_presc_link:hover{
            background: #FFF;
            color: #0056b3;
        }
        #new_presc_link:before{
            width: 0;
        }
        .modal{
            overflow: unset;
        }
        .pro-img{
            max-width: 150px;
            max-height: 150px;
        }
        .blocker{
            z-index: 1000;
        }
        @media only screen and (max-width: 767px) {
            .modal{
                width:100%;
                font-size: 12px;
            }
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
                <h1>@lang('trans.prescriptions')</h1>
                <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.prescriptions')</a></li>
                    </ul>
                </div>
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

<!-- Track Order Section Start -->
<div class="track-order-section section mt-90 mb-50">
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success text-center">
                {!! \Session::get('success') !!}
            </div>
        @elseif (\Session::has('error'))
            <div class="alert alert-danger text-center">
                {!! \Session::get('error') !!}
            </div>
        @endif

        <div class="row align-items-center">

            <div class="track-order-title text-center col-12 mb-80">
                <h2>@lang('trans.prescriptions')...</h2>
                <p>To track your order please enter your Order ID in the box below and press the “Track” button. This was give to you on your receipt and in the confirmation email you should have reveived</p>
            </div>

        </div>

        <div id="orders_div" class="row align-items-center text-center">
            <a id="new_presc_link" class="btn btn-default" href="{{route('showUploadPrescription')}}">@lang('trans.order_new_presc')</a>

            @include('customer_prescriptions')

        </div>
    </div>
</div><!-- Track Order Section End -->




@include('layouts.brands')


@include('layouts.subscribe')
@endsection


@section('script_bottom')
<script>



</script>
@endsection