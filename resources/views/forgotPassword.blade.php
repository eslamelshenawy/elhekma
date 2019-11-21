@extends('layouts.header')
@section('content')
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center"></div>
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
               <h1>Reset Password</h1>

            </div>
        </div>



    </div>
</div><!-- Page Banner Section End -->


<div class="login-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
                <div class="col-md-4 col-12 d-flex"></div>
            <!-- Login -->
            <div class="col-md-4 col-12 d-flex">
                <div class="ee-login">


                    <!-- Login Form -->
                    <form action="{{ url('sendResetEmailWeb') }}" method="POST">
                        @csrf
                        @if (session('message'))
                        <div class=" alert alert-danger">{{session('message')}}</div>
                        @endif
                        <div class="row">
                            <div class="col-12 mb-30"><input type="text" name='email' placeholder="Type email address"></div>

                            <div class="col-12"><input type="submit" value="Reset"></div>
                        </div>
                    </form>
                    <h4>Don’t have account? please click <a href="{{ route('register') }}">Register</a></h4>

                </div>
            </div>

            <!-- Login With Social -->

        </div>
    </div>
</div><!-- Login Section End -->

@include('layouts.brands')

@endsection
