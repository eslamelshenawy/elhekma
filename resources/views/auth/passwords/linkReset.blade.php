<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Appsinnovate" />
    <meta name="description" content="H&S - Reset Password" />
    <meta name="keywords" content="H&S" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- SITE TITLE -->
    <title>H&S - Reset Password</title>

    <!-- FAVICON -->
    {{-- <link rel="icon" href="{{URL::asset('assets/resetPassword/images/favicon.ico')}}"> --}}

    <!-- WEB FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600,700' rel='stylesheet' type='text/css'>
       <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/resetPassword/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/resetPassword/fonts/flaticon.css')}}" />
   <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/resetPassword/css/responsive.css')}}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- JQUERY -->

    <style>
#fp-nav li a.active { box-shadow: inset 0 0 0 8px #54ff7b;display: none!important; }

    </style>
</head>

<body>

    <!-- PRELOADER -->



    <!-- MAIN NAV -->

    <!-- END MAIN NAV -->

    <!-- PAGE LOGO -->

    <!-- END PAGE LOGO -->

    <!-- LANDING PAGE CONTENT -->
    <div id="fullpage">

        <!-- RIGHT HAND & PHONE MOCK-UP IMAGES -->
        <div class="wrap">

            <div id="hand"></div>
        </div>
        <!-- END RIGHT HAND & PHONE MOCK-UP -->


        <!-- SECTION HOME -->
        <div class="section " id="section0">
            <div class="wrap">
                <div class="box">
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <!-- SECTION HOME CONTENT -->

                    @if(isset($_GET['lang_id']) == 2)
                    <h1>اعاده تعيين كلمه السر</h1><br><br>
                    @else
                    <h1>Reset Password</h1><br><br>
                    @endif

                    <form action="{{url('password/reset')}}" method="POST" class="form">
                        @csrf()

                         <input type="hidden" name="token" value="{{$token}}">

                        <div class="form-group">
                            <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                  <input id="email" name="email" placeholder="Email Address" class="form-control"  type="email" value="{{$email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                    @if(isset($_GET['lang_id']) == 2)
                            <input id="password" name="password" placeholder="كلمه السر" class="form-control"  type="password">
                    @else
                            <input id="password" name="password" placeholder="New Password" class="form-control"  type="password">
                    @endif

                            </div>
                        </div>
                    <div class="form-group">
                        <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                    @if(isset($_GET['lang_id']) == 2)
                              <input id="password_confirmation" name="password_confirmation" placeholder="اعاده تعيين كلمه السر" class="form-control"  type="password">
                    @else
                              <input id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" class="form-control"  type="password">
                    @endif
                        </div>
                    </div>
                      <div class="form-group">

                        @if(isset($_GET['lang_id']) == 2)
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="تعيين كلمه السر" type="submit">
                        @else
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        @endif

                      </div>
                    </form>
                </div>
                    <!-- END SECTION HOME CONTENT -->
            </div>
        </div>
        <!-- END SECTION HOME -->

    {{-- <!-- SCRIPTS -->
    <script src="{{URL::asset('assets/resetPassword/js/jquery.easings.min.js')}}"></script>
    <script src="{{URL::asset('assets/resetPassword/js/jquery.fullPage.js')}}"></script>
    <script src="{{URL::asset('assets/resetPassword/js/cbpFWTabs.js')}}"></script>
    <script src="{{URL::asset('assets/resetPassword/js/jquery.sidr.min.js')}}"></script>
    <script src="{{URL::asset('assets/resetPassword/js/scripts.js')}}"></script> --}}
</body>

</html>
