            <!-- Banner -->
            @foreach ($ads as $ad)
            <div class="col-md-4 col-12 mb-30">
                <div class="banner"><a target="blanck_" href="{{ $ad->link }}"><img src="{{ urldecode(URL::to('/uploads',$ad->image))}}" alt="{{$ad->link}}" width="200px" height="250px"></a></div>
            </div>

            @endforeach
