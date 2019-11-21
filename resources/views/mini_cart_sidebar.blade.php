@if(\App\Models\customer::getCart())

    <ul class="mini-cart-products">
    <?php $total_price = 0; ?>
    @foreach(\App\Models\customer::getCart() as $item)
    <?php $total_price += $item['quantity_price'];?>
    <li class="cart_item ">
        {{--update image with product image--}}
        <a href="{{ route('singleProduct',[ 'id'  => $item['product_id']]) }}" class="image"><img src="@if($item['product_image']) {{urldecode(URL::to('/uploads',$item['product_image']))}} @else assets/images/product/product-1.png @endif" alt="Product"></a>
        <div class="content">
            <a href="{{ route('singleProduct',[ 'id'  => $item['product_id']]) }}" class="title">
                @if(\App::isLocale('en'))
                {{$item['product_name']}}
                @else
                {{$item['product_name_ar']}}
                @endif
            </a>
            <span class="price">Price: {{$item['quantity_price']}}</span>
            <span class="qty">Qty: {{$item['quantity']}}</span>
        </div>
        <button class="remove" data-id="{{$item['product_id']}}"><i class="fa fa-trash-o"></i></button>
    </li>
    @endforeach
</ul>
@endif

<div class="mini-cart-bottom">

    @if(isset($total_price))
    <h4 class="sub-total">@lang('trans.total'): <span>{{$total_price}}</span></h4>
    @endif

    <div class="button">
        <a href="{{ route('cartPage') }}">@lang('trans.cart')</a>
    </div>

    <div class="button">
        <a href="{{ route('checkout') }}">@lang('trans.checkout')</a>
    </div>
</div>

