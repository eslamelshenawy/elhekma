<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Haithem & Salah Pharmacies</title>

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}} ">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styleUpdates.css')}} ">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}} ">

    <style>
        #main_contents{
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="main_contents">
        <h5 style="text-align: center">Thanks for purchasing Order #{{$order->id}}</h5>

        <table class="table table-striped">
            <tbody>
            <tr>
                <th scope="row">ID</th>
                <td>{{$order->id}}</td>
            </tr>
            <tr>
                <th scope="row">Total</th>
                <td>{{$order->total}}</td>
            </tr>
            <tr>
                <th scope="row">Address</th>
                <td>{{$order->deliveryAddress->first_name}} {{$order->deliveryAddress->last_name}}, {{$order->deliveryAddress->address}}</td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>{{$order->orderStatus->title}}</td>
            </tr>
            </tbody>
        </table>

        <h5>Items:</h5>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Branch</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderDetails as $item)
                <tr>
                    <th scope="row"><a target="_blank" href="{{ route('singleProduct',[ 'id'  => $item->id])}}">{{$item->product->name_en}}</a></th>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->sub_total}}</td>
                    <td>{{$item->outlet->place->name_en}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
