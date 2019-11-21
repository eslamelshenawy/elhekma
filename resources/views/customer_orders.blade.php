@if($orders)
<div class="cart-table table-responsive mb-40">
    <table class="table">
        <thead>
        <tr>
            <th class="pro-thumbnail">@lang('trans.order_tracking_id')</th>
            <th class="pro-title">@lang('trans.items_count')</th>
            <th class="pro-price">@lang('trans.total')</th>
            <th class="pro-subtotal">@lang('trans.status')</th>
            <th>@lang('trans.date')</th>
            <th class="pro-remove">@lang('trans.options')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        @php
        $i=0;
        foreach($order->orderDetails as $item){
            $i+= $item->quantity;
        }
        @endphp
        <tr>
            <td class="pro-id"><a style="text-decoration: underline" href="#order{{$order->id}}" rel="modal:open">{{$order->id}}</a></td>
            <td class="pro-quantity" ><a style="text-decoration: underline" href="#order{{$order->id}}" rel="modal:open">{{$i}}</a></td>
            <td class="pro-price"><a style="text-decoration: underline" href="#order{{$order->id}}" rel="modal:open"><span>{{$order->total}}</span></a></td>
            <td class="pro-status"><span>
                    @if(\App::isLocale('en'))
                    {{$order->orderStatus->title}}
                    @else
                    {{$order->orderStatus->title_ar}}
                    @endif
                </span></td>
            <td class="pro-status"><span>{{$order->created_at}}</span></td>
            <td class="pro-cancel">
                @if(trim($order->orderStatus->title) == 'Pending')
                <a title="@lang('trans.cancel_order')" id="cancel_order" style="margin-right: 5px;" href="{{route('cancelOrder')}}" data-id="{{$order->id}}" ><i class="fa fa-times"></i></a>
                @endif

                <a title="@lang('trans.reorder')" id="reorder" href="{{route('reorder', $order->id)}}" data-id="{{$order->id}}" ><i class="fa fa-retweet"></i></a>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

@if(!is_array($orders))
{{ $orders->links() }}
@endif
@endif


@if($orders)
@foreach($orders as $order)

    <div id="order{{$order->id}}" class="modal table-responsive">

        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row">@lang('trans.order_tracking_id')</th>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <th scope="row">@lang('trans.total')</th>
                    <td>{{$order->total}}</td>
                </tr>
                <tr>
                    <th scope="row">@lang('trans.shipping_cost')</th>
                    <td>{{$order->shipping_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">@lang('trans.address')</th>
                    <td>{{$order->deliveryAddress->first_name}} {{$order->deliveryAddress->last_name}}, {{$order->deliveryAddress->address}}</td>
                </tr>
                <tr>
                    <th scope="row">@lang('trans.status')</th>
                    <td>
                        @if(\App::isLocale('en'))
                        {{$order->orderStatus->title}}
                        @else
                        {{$order->orderStatus->title_ar}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">@lang('trans.date')</th>
                    <td>{{$order->created_at}}</td>
                </tr>
            </tbody>
        </table>

        <h4>@lang('trans.items'):</h4>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('trans.product')</th>
                    <th>@lang('trans.quantity')</th>
                    <th>@lang('trans.price')</th>
                    <th>@lang('trans.branch')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $item)
                <tr>
                    <th scope="row"><a target="_blank" href="{{ route('singleProduct',[ 'id'  => $item->product_id])}}">
                            @if(\App::isLocale('en'))
                            {{$item->product->name_en}}
                            @else
                                @if($item->product->name_ar)
                                    {{$item->product->name_ar}}
                                @else
                                    {{$item->product->name_en}}
                                @endif
                            @endif
                        </a></th>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->sub_total}}</td>
                    <td>
                        @if(\App::isLocale('en'))
                        {{$item->outlet->place->name_en}}
                        @else
                        {{$item->outlet->place->name_ar}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach
@endif