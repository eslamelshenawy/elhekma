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
        .modal{
            overflow: unset;
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
                <h1>@lang('trans.track_order')</h1>
                <p>similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita</p>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">@lang('trans.track_order')</a></li>
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
                <h2>@lang('trans.track_order')...</h2>
                <p>To track your order please enter your Order ID in the box below and press the “Track” button. This was give to you on your receipt and in the confirmation email you should have reveived</p>
            </div>

            <div class="col-lg-6 col-md-7 col-12 mb-40">
                <div class="track-order-form">
                    <form action="{{ route('filterOrders') }}" id="filterOrders">
                        <label for="order_id">@lang('trans.order_id')</label>
                        <input type="text" name="order_id" id="order_id"  required>
                        <input type="submit" value="@lang('trans.filter')">
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 col-12 ml-auto mb-40">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-33.jpg" alt="Banner"></a></div>
            </div>

        </div>

        <div id="orders_div" class="row align-items-center">
            @include('customer_orders')

        </div>
    </div>
</div><!-- Track Order Section End -->




@include('layouts.brands')


@include('layouts.subscribe')
@endsection


@section('script_bottom')
<script>


    $('#filterOrders').on('submit', function(){
        var url = $(this).attr('action');
        var order_id = $('#order_id').val();

        var data = new FormData();
        data.append('order_id', order_id);

        $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                console.log(data);
                if (data) {
                    $('#orders_div').html(data);
                }
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr);
            }
        });
        return false;
    });

    $(document).on("click", "#orders_div .pagination a", function () {
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'GET',
            success: function (data) {
                $('#orders_div').html(data);
            },
            error: function (xhr, textStatus, errorThrown) {
            }
        });

        return false;
    });

    $(document).on("click", ".pro-cancel #cancel_order", function () {
        var url = $(this).attr("href");
        var id = $(this).attr('data-id');

        var data = new FormData();
        data.append('id', id);

        $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                console.log(data);
                if (data) {
                    $('#orders_div').html(data);
                }
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr);
            }
        });

        return false;
    });
</script>
@endsection