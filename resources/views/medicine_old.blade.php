@extends('layouts.header')

@section('content')
<style>
    .design{

            font-size: 12px;
            border-radius: 5px;
            line-height: 20px;
            background-color: white;
            border: 1px solid #e4e4e4;
            width: 92%;
            /* margin: auto; */
            padding: 10px 9px;
    }
</style>
<script type="text/javascript">
       $(document).ready(function() {
             $('#products').on('input',function() {

                var availableProducts=[];
              name_en=$('#products').val();
                $.ajax({
                         type: "GET",
                            // url: "{{ URL('changelanguage') }}",
                            url:"/auto_complete_products/"+name_en,
                            data: {
                             // "name_en": language,
                            },
                            success: function (response) {
                                console.log(response);
                                for (let index = 0; index < response.length; index++) {
                                    availableProducts.push(response[index].name_en);
                                }
                                $( "#products" ).autocomplete({
                                    source: availableProducts
                                });

                            },
                            error: function (error) {

                            }
                });
            });
        });

</script>
<script type="text/javascript">
$( function() {
$('#comapny').on('input',function() {
    var availableComapines=[];
  name_en=$('#comapny').val();
    $.ajax({
             type: "GET",
                // url: "{{ URL('changelanguage') }}",
                url:"/auto_complete_companies/"+name_en,
                data: {
                 // "name_en": language,
                },
                success: function (response) {
                    for (let index = 0; index < response.length; index++) {
                        availableComapines.push(response[index].name_en);
                    }
                    $( "#comapny" ).autocomplete({
                        source: availableComapines
                    });

                },
                error: function (error) {

                }
    });
});
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>
//   $( function() {
//     var availableProducts = [
//       "ActionScript",
//       "AppleScript",
//       "Asp",
//       "BASIC",
//       "C",
//       "C++",
//       "Clojure",
//       "COBOL",
//       "ColdFusion",
//       "Erlang",
//       "Fortran",
//       "Groovy",
//       "Haskell",
//       "Java",
//       "JavaScript",
//       "Lisp",
//       "Perl",
//       "PHP",
//       "Python",
//       "Ruby",
//       "Scala",
//       "Scheme"
//     ];
//     $( "#products" ).autocomplete({
//       source: availableProducts
//     });
//   });
  </script>
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner" style="padding-top: 50px; padding-bottom: 30px">
                <h1>Medicine </h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">Medicine VIEW</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-15.jpg" class="d-none" alt="Banner"></a></div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="assets/images/banner/banner-14.jpg" class="d-none" alt="Banner"></a></div>
        </div>

    </div>
</div><!-- Page Banner Section End -->

<!-- Product Section Start -->
<div class="product-section section mt-10 mb-90">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-12" style="background-color: #fefefe">

                <div class="blog-sidebar mb-5">

                    <h4 class="title"><img src="assets/images/product/settings.png">Medicine Smart Search</h4>

                    <div class="ee-login">
                        <!-- Filter Form -->
                        <form action="{{action('MedicineController@search')}}" method="POST" style="margin-top: 15px">
                            @csrf()
                            <div class="row">
                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <div class="magnify"><i class="fa fa-search"></i> </div>
                                    <input type="text" placeholder="Insert Your Keyword" name="name_en" id="products" style="
                                    font-size: 12px;
                                    border-radius: 0 5px 5px 0;
                                    line-height: 20px;
                                    background-color: white;
                                    border: 1px solid #e4e4e4;
                                    width: 78%;
                                    /* margin: auto; */
                                    padding: 10px 9px;
                                    border-left: none">
                                </div>

                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <select class="js-example-basic-single design" name="brand_id">
                                    <option disabled selected>Company</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}" >{{$company->name_en}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal pb-10" style="font-size: 14px">Target Audience</h4>
                                    </div>
                                </div>
                                <div class="col-12" style="border-bottom: 1px solid #e4e4e4; padding-bottom: 10px">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($targetAudiences as $targetAudience)

                                            <div class="col-lg-6">
                                                <label class="control control--checkbox">{{$targetAudience->name_en}}
                                                    <input type="checkbox" value="{{$targetAudience->id}}"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>



                                <!------------- Filter By Age -------------->
                                <div class="col-12 mb-30 d-flex flex-row justify-content-center ">

                                {{--<select name="targetAudience_id" class="js-example-basic-single design" style="padding-bottom: 33px !important;padding-top: 3px !important;">
                                 <option  disabled selected>Target Audience</option>
                                    @foreach($targetAudiences as $targetAudience)
                                    <option value="{{$targetAudience->id}}">{{$targetAudience->name_en}}</option>
                                    @endforeach
                                </select>--}}

                                            {{--  <!-- <div class="col-lg-6">
                                                <label class="control control--checkbox">Children
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div> -->
                                        <!-- </div> -->  --}}
                                    </div>



                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 class="font-weight-normal pb-10" style="font-size: 14px">Select Specialist</h4>
                                    </div>
                                </div>
                                <div class="col-12" style="border-bottom: 1px solid #e4e4e4; padding-bottom: 10px">
                                    <div class="container-fluid">

                                            @foreach($categories as $category)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control control--checkbox">{{$category->name_en}}
                                                        <input type="radio" name="category_id" value="{{$category->id}}"/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach

                                    </div>
                                </div>


                                <!------------- Custom Specialist -------------->
                                <div class="col-12 mb-30 d-flex flex-row justify-content-center ">
                                <select name="category_id" class="js-example-basic-single design">
                                    <option disabled selected >Select Specialist</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name_en}}</option>
                                    @endforeach
                                </select>


                                    </div>

                                <div class="col-12 mb-30 d-flex flex-row justify-content-center ">
                                <select name="pharmaceuticalForm_id" class="js-example-basic-single design ">
                                    <option disabled selected>Pharmaceutical Form</option>
                                    @foreach($pharmaceuticalForms as $pharmaceuticalForm)
                                    <option value="{{$pharmaceuticalForm->id}}">{{$pharmaceuticalForm->name_en}}</option>
                                    @endforeach
                                </select>

                                    </div>

                                <div class="col-12 mb-30 d-flex flex-row justify-content-center ">
                                            <select class="js-example-basic-single design " name="active_Ingredient_id">
                                            <option disabled selected>Active Ingredients</option>
                                            @foreach($active_Ingredients as $active_Ingredient )
                                            <option value="{{$active_Ingredient->id}}">{{$active_Ingredient->name_en}}</option>
                                            @endforeach
                                        </select>

                                            </div>


                                <div class="col-12">
                                    <div class="container-fluid">
                                        <div class="sidebar-price d-flex flex-row justify-content-center">
                                            <input type="submit" value="Filter" class="text-white" style="font-size: 14px; padding: 7px 9px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            <div class="col-lg-9 col-12">

                <div class="row mb-50">
                    <div class="col">

                        <!-- Shop Top Bar Start -->
                        <div class="shop-top-bar">

                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                            </div>

                            <!-- Product Showing -->
                            <div class="product-showing">
                                <p>Showing</p>
                                <form method="get" action="{{action('MedicineController@medicinePage')}}"></form>

                                <select name="showing" class="nice-select">
                                    <option value="1">8</option>
                                    <option value="2">12</option>
                                    <option value="3">16</option>
                                    <option value="4">20</option>
                                    <option value="5">24</option>
                                </select>
                            </div>

                            <!-- Product Short -->
                            <div class="product-short">
                                <p>Sort By</p>
                                <select name="sortby" class="nice-select">
                                    <option value="trending">Brands</option>
                                    <option value="sales">Best sellers</option>
                                    <option value="rating">Best rated</option>
                                    <option value="date">Newest items</option>
                                    <option value="price-asc">Price: low to high</option>
                                    <option value="price-desc">Price: high to low</option>
                                </select>
                                </form>
                            </div>

                            <!-- Product Pages -->
                            <div class="product-pages">
                            <p>Pages {{$medicineData->currentPage()}} of {{$medicineData->lastPage()}}</p>

                            </div>

                        </div><!-- Shop Top Bar End -->

                    </div>
                </div>

                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid row">
                @foreach($medicineData as $medicine)
                    <div class=" col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-2.png" alt="{{$medicine->name_en}}"></a>

                                <div class="wishlist-compare">
                                    <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                    <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                </div>

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="#" class="cat">Drone</a>
                                    <h5 class="title"><a href="single-product.html">{{$medicine->name_en}}</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price"><span class="old">${{$medicine->price_before}}</span>${{$medicine->price}}</h5>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                </div>

                            </div>

                        </div><!-- Product End -->

                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">

                                <span class="label sale">sale</span>

                                <a href="single-product.html" class="img"><img src="assets/images/product/product-2.png" alt="Product Image"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        <a href="#" class="cat">Drone</a>
                                        <h6 class="title"><a href="single-product.html">{{$medicine->name_en}}</a></h6>
                                    </div>

                                    <h5 class="price"><span class="old">${{$medicine->price_before}}</span>${{$medicine->price}}</h5>

                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p> {{$medicine->desc_en}}</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
                                            <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                            <a href="#" data-tooltip="Wishlist"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Diagonal Size 350mm</li>
                                            <li>Max Speed 16m/s (ATTI mode)</li>
                                            <li>Maz Flight Time  Approx. 25min</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>

                            </div>

                        </div><!-- Product List End -->
                    </div>
@endforeach

                </div><!-- Shop Product Wrap End -->

                <div class="row mt-30">
                    <div class="col">
                    <?php
                    $data=array();
                    if (isset($_GET['target_audience_id'])) {
                        $data['target_audience_id'] =$_GET['target_audience_id'];
                    }
                    if (isset($_GET['pharmaceutical_form_id'])) {
                        $data['pharmaceutical_form_id'] =$_GET['pharmaceutical_form_id'];
                    }
                    if (isset($_GET['categories_id'])) {
                        $data['categories_id'] =$_GET['categories_id'];
                    }
                    if (isset($_GET['name_en'])) {
                        $data['name_en'] =$_GET['name_en'];
                    }
                    if (isset($_GET['company'])) {
                        $data['company'] =$_GET['company'];
                    }
                    ?>
                    <?php echo $medicineData->appends($data)->render(); ?>

                        <!-- <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-left"></i>Back</a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li> - - - - - </li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">20</a></li>
                            <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                        </ul> -->

                    </div>
                </div>

            </div>


        </div>
    </div>
</div><!-- Feature Product Section End -->
@include('layouts.brands')

@include('layouts.subscribe')
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
