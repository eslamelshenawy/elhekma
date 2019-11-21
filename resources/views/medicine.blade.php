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
{{--
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
--}}


<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner" style="padding-top: 50px; padding-bottom: 30px">
                <h1>
                @if(app()->getLocale() == "ar")
                    @if(empty($slug_ar))
                    {{$slug_en}}
                    @else
                    {{$slug_ar}}
                    @endif
                @else
                {{$slug_en}}
                @endif                   
                
                 </h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">@lang('trans.home')</a></li>
                        <li><a href="#">
                @if(app()->getLocale() == "ar")
                    @if(empty($slug_ar))
                    {{$slug_en}}
                    @else
                    {{$slug_ar}}
                    @endif
                @else
                {{$slug_en}}
                @endif @lang('trans.view')</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="{{asset('assets/images/banner/banner-15.jpg')}}" class="d-none" alt="Banner"></a></div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="{{asset('assets/images/banner/banner-14.jpg')}}" class="d-none" alt="Banner"></a></div>
        </div>

    </div>
</div><!-- Page Banner Section End -->

<!-- Product Section Start -->
<div class="product-section section mt-10 mb-90">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-12" style="background-color: #fefefe">

                <div class="blog-sidebar mb-5">

                    <h4 class="title"><img src="{{asset('assets/images/product/settings.png')}}">
                @if(app()->getLocale() == "ar")
                    @if(empty($slug_ar))
                    {{$slug_en}}
                    @else
                    {{$slug_ar}}
                    @endif
                @else
                {{$slug_en}}
                @endif                   
                 @lang('trans.smart_search')</h4>

                    <div class="ee-login">
                        <!-- Filter Form -->
                        <form action="{{route('search.product',Request::route('slug'))}}" method="POST" style="margin-top: 15px">
                                @csrf()
                            <div class="row">
                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <div class="magnify"><i class="fa fa-search"></i> </div>
                                    <input type="text" placeholder="@lang('trans.keyword')" id="filter" name="name_en" class="style" value="{{ Request::post('name_en') }}">
                                </div>

                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <input type="text" placeholder="@lang('trans.company')..." id="company" name="brand_name" style="
                                    font-size: 12px;
                                    border-radius: 5px;
                                    line-height: 20px;
                                    background-color: white;
                                    border: 1px solid #e4e4e4;
                                    width: 92%;
                                    /* margin: auto; */
                                    padding: 10px 9px;" value="{{ Request::post('brand_name') }}">
                                </div>

                                <div class="col-12 mb-30 d-flex flex-row justify-content-center">
                                    <input type="text" placeholder="@lang('trans.ingredient')..." id="tags" name="active_Ingredient_id" style="
                                    font-size: 12px;
                                    border-radius: 5px;
                                    line-height: 20px;
                                    background-color: white;
                                    border: 1px solid #e4e4e4;
                                    width: 92%;
                                    /* margin: auto; */
                                    padding: 10px 9px;" value="{{ Request::post('active_Ingredient_id') }}">
                                </div>

                                <!------------- Filter By Target Audience -------------->
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <h4 data-toggle="collapse" data-target="#target-audience"  class="font-weight-normal pb-10" style="font-size: 14px; padding-top: 10px">@lang('trans.target_audience')</h4>
                                    </div>
                                </div>
                                <div class="col-12 mb-15 collapse" id="target-audience">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($targetAudiences as $targetAudience)

                                                <div class="col-lg-6">
                                                    <label class="control control--checkbox">
                                                        @if(isset($targetAudience->$name))
                                                        {{$targetAudience->$name}}
                                                        @else
                                                        {{$targetAudience->name_en}}
                                                        @endif
                                                        <input type="radio" id="target_audience_id" name="target_audience_id" value="{{$targetAudience->id}}"
                                                        @if( Request::post('target_audience_id') == $targetAudience->id ) checked @endif/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <!------------- Custom Specialist -------------->
                                <div class="col-12" style="border-top: 1px solid #e4e4e4; padding-top: 10px">
                                    <div class="container-fluid">
                                        <h4 data-toggle="collapse" data-target="#specialist"  class="font-weight-normal pb-10" style="font-size: 14px; padding-top: 10px">@lang('trans.select_specialist')</h4>
                                    </div>
                                </div>
                                <div class="col-12 mb-15 collapse" id="specialist">
                                    <div class="container-fluid">

                                            @foreach($categories as $category)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control control--checkbox">
                                                        @if(isset($category->$name))
                                                        {{$category->$name}}
                                                        @else
                                                        {{$category->name_en}}
                                                        @endif                                                        
                                                        <input type="radio" id="category_id" name="category_id" value="{{$category->id}}" @if( Request::post('category_id') == $category->id ) checked @endif/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>
                                </div>

                                <!------------- Filter Medicine Forum -------------->
                                <div class="col-12" style="border-top: 1px solid #e4e4e4; padding-top: 10px">
                                    <div class="container-fluid">
                                        <h4 data-toggle="collapse" data-target="#pharmaceutical_form"  class="font-weight-normal pb-10" style="font-size: 14px; padding-top: 10px">@lang('trans.medicine_forum')</h4>
                                    </div>
                                </div>
                                <div class="col-12 mb-15 collapse" id="pharmaceutical_form">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($pharmaceuticalForms as $pharmaceuticalForm)

                                                <div class="col-lg-6">
                                                    <label class="control control--checkbox">{{$pharmaceuticalForm->$name}}
                                                        <input type="radio" id="pharma_form_id" name="pharma_form_id" value="{{$pharmaceuticalForm->id}}" @if( Request::post('pharma_form_id') == $pharmaceuticalForm->id ) checked @endif/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="container-fluid">
                                        <div class="sidebar-price d-flex flex-row justify-content-center">
                                            <input type="submit" value="@lang('trans.filter')" class="text-white" style="font-size: 14px; padding: 7px 9px">
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
                                <!-- <a href="#"><i class="fa fa-sort" id="orderBy"></i></a> -->
                                <div class="product-showing">
                                <select name="orderBy" class="nice-select" id="orderBy">
                                    <option value="desc">@lang('trans.desc')</option>
                                    <option value="asc">@lang('trans.asc')</option>

                                </select>
                                </div>
                            </div>
                            

                            
                            <!-- Product Showing -->
                            <div class="product-showing">
                                <p>@lang('trans.show')</p>
                                <select name="perPage" class="nice-select" id="perPage">
                                    <option value="8">8</option>
                                    <option value="12">12</option>
                                    <option value="16">16</option>
                                    <option value="20">20</option>
                                    <option value="24">24</option>
                                </select>
                            </div>

                            <!-- Product Short -->
                            <div class="product-short">
                                <p>@lang('trans.sortBy')</p>
                                <select name="sortBy" class="nice-select" id="sortBy">
                                    <option value="$name">@lang('trans.name')</option>
                                    <option value="price">@lang('trans.price')</option>
                                </select>


                            </div>
                                
                            <!-- Product Pages -->
<!--                             <div class="product-pages">

                                <p>Pages {{$medicineData->currentPage()}} of {{$medicineData->lastPage()}}</p>
                            </div> -->

                        </div><!-- Shop Top Bar End -->

                    </div>
                </div>

                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid row" id="medicine_search">
                    @include('medicine_products')
                </div><!-- Shop Product Wrap End -->



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
    /*var availableTags = [
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
    ];*/
      var availableTags = [@foreach($active_Ingredients as $k => $info)
          '{{ $info['name_en'] }}',
          @endforeach ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  $( function() {
     // var availableBrands = '';
      var availableBrands = [@foreach($companies as $k => $info)
          '{{ $info['name_en'] }}',
          @endforeach ];
      $( "#company" ).autocomplete({
          source: availableBrands
      });
  } );

  </script>
<script type="text/javascript">
$( function() {
$('#perPage').on('change',function(e) {
    e.preventDefault();
    var perPage = $('#perPage').val();
    var brand_name = $('#company').val();
    var active_Ingredient_id = $('#tags').val();
    var category_id = $('#category_id:checked').val();
    var target_audience_id = $('#target_audience_id:checked').val();
    var pharma_form_id = $('#pharma_form_id:checked').val();

    var data = new FormData();
    data.append('brand_name', brand_name);
    data.append('active_Ingredient_id', active_Ingredient_id);
    data.append('category_id', category_id);
    data.append('target_audience_id', target_audience_id);
    data.append('pharma_form_id', pharma_form_id);

    
    $.ajax({
                url:"{{route('search.product',['slug' => Request::route('slug')])}}?perPage="+perPage,
                data: data,
                type: "{{ Request::method() }}",
                processData: false,
                contentType: false,                
                success: function (data) {
                console.log(data);
                 if (data) {
                    $('#medicine_search').html(data);
                }
                },
                error: function (error) {

                }
    });
});
});
</script>

<script type="text/javascript">
$( function() {
$('#sortBy').on('change',function(e) {
    e.preventDefault();
    var sortBy = $('#sortBy').val();
    var brand_name = $('#company').val();
    var active_Ingredient_id = $('#tags').val();
    var category_id = $('#category_id:checked').val();
    var target_audience_id = $('#target_audience_id:checked').val();
    var pharma_form_id = $('#pharma_form_id:checked').val();

    var data = new FormData();
    data.append('brand_name', brand_name);
    data.append('active_Ingredient_id', active_Ingredient_id);
    data.append('category_id', category_id);
    data.append('target_audience_id', target_audience_id);
    data.append('pharma_form_id', pharma_form_id);    
    $.ajax({
                url:"{{route('search.product',['slug' => Request::route('slug')])}}?sortBy="+sortBy,
                data: data,
                type: "{{ Request::method() }}",
                processData: false,
                contentType: false,                 
                success: function (data) {
                 if (data) {
                    $('#medicine_search').html(data);
                }
                },
                error: function (error) {

                }
    });
});
});
</script>

<script type="text/javascript">
$( function() {
$('#orderBy').on('change',function(e) {
    e.preventDefault();
    var orderBy = $('#orderBy').val();
    var brand_name = $('#company').val();
    var active_Ingredient_id = $('#tags').val();
    var category_id = $('#category_id:checked').val();
    var target_audience_id = $('#target_audience_id:checked').val();
    var pharma_form_id = $('#pharma_form_id:checked').val();

    var data = new FormData();
    data.append('brand_name', brand_name);
    data.append('active_Ingredient_id', active_Ingredient_id);
    data.append('category_id', category_id);
    data.append('target_audience_id', target_audience_id);
    data.append('pharma_form_id', pharma_form_id);    
    $.ajax({
                url:"{{route('search.product',['slug' => Request::route('slug')])}}?orderBy="+orderBy,
                data: data,
                type: "{{ Request::method() }}",
                processData: false,
                contentType: false,                 
                success: function (data) {
                 if (data) {
                    $('#medicine_search').html(data);
                }
                },
                error: function (error) {

                }
    });
});
});
</script>

