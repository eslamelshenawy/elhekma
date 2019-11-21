@if($prescriptions)
    <div class="cart-table table-responsive mb-40 ">
        <table class="table">
            <thead>
            <tr>
                <th class="pro-thumbnail">@lang('trans.id')</th>
                <th class="pro-title">@lang('trans.name')</th>
                <th class="pro-title">@lang('trans.image')</th>
                <th class="pro-subtotal">@lang('trans.status')</th>
                <th>@lang('trans.date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td class="pro-id">{{$prescription->id}}</td>
                    <td class="pro-quantity" >{{$prescription->first_name}} {{$prescription->last_name}}</td>
                    <td class="pro-img" >
                        <a href="{{ urldecode(URL::to('/uploads',$prescription->image)) }}" target="_blank">
                            <img style="max-width:100px;max-height:100px;" src="{{ urldecode(URL::to('/uploads',$prescription->image)) }}">
                        </a>
                    </td>
                    <td class="pro-status"><span>
                    @if($prescription->status == \App\Models\Prescription::STATUS_ORDERED)
                                <a href="{{route('trackOrder')}}">{{$prescription->getStatus()}}</a>
                            @else
                                {{$prescription->getStatus()}}
                            @endif
                </span></td>
                    <td class="pro-status"><span>{{$prescription->created_at}}</span></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if(!is_array($prescriptions))
        {{ $prescriptions->links() }}
    @endif

@else
    <h3 style="text-align: center;width:100%;">No prescriptions added yet</h3>
@endif

