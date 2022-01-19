<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
    <title></title>
    <style>
      .thanks{
    font-size: 30px;
}
body{
 
    background-color: #ecf0f1;
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;

}
.invoice-inner{
    height: 100%;
    width: 100%;
    position: absolute;
 
 
}
.invoice{
  width: 50%;
    height:900px;
    display: grid;
    place-items: center;
 
    text-align:center;


    margin-top: 60px;
    position: relative;

}
.order{
    width:100%;
    background-color: white;
    padding: 15px 15px;
 
 
}
.order span{

    color: #7f8c8d;
}
.shop-details{
    margin-right: 0;
    padding-right: 0;
}

.total{
    margin-left: 50px !important;
}
.view{
    background-color: white;
    height: 150px;
    display: grid;
    place-items: center;
    padding: 20px 0;
    margin-bottom: 100px;
  
  
    
}
.invoice tr{
  border: 1px solid black;
}
.viewbutton{
    border-radius: 20px;
}
.viewbutton a{
    text-decoration: none;
    color: red;
}
.viewbutton:hover{
    background-color: white;
}
    </style>
</head>
<body>
  @php
  $shop=Session::get('shop');
  $shop_id=$shop->id;
  $district_id=$shop->district_id;
  $district=DB::table('districts')->where('id',$district_id)->first();
  $district_name=$district->district_name;
 
  $shop_name=$shop->shop_name;
  $shop_area=$shop->shop_area;
  $shop_city=$shop->shop_city;
  $content=Cart::content();

  $order_id=$order_id['order_id'];

$orderTable=DB::table('orders')->where('id',$order_id)->first();


  @endphp
    <section class="invoice mt-5 mb-5">
    <div class="row invoice-inner mb-5">
        <h2 class="mt-5">Amar Dukan</h2>
        <p class="mb-2 thanks">Thank you for shopping with us!</p>
    

        <h5 class=" mt-5">Shipping Address</h5>
        <p class="">Daffodial Internatioal University,Ashulia</p>

        <div class="order">
            <div class="row order-div">
                <div class="col-md-6">
                <p> Order Id: <span class="text-danger "> {{ $order['order_id'] }} </span> </p>
            <p> Invoice Date: <span>{{ date('d F , Y' ,strtotime($order['date']) ) }} </span> </p>
                </div>
                <div class="col-md-6 shop-details">
                <p>Shop Name: <span >{{$shop_name}}</span> </p>
            <p>Shop Address: <span>{{$shop_area}},{{$shop_city}},{{$district_name}}</span> </p>
                </div>
            </div>
      
        </div>

        <div class="order-details mt-4">
            <table class="table invoice-table ">
            <thead>
                    <tr>
                      <th >Product</th>
                      <th >Shop name</th>
                      <th  >Quantity</th>
                      <th  >Total</th>
                
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($content as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->shop_name}}</td>
                            <td>{{$row->qty}}</td>
                            <td >{{$row->price * $row->qty}}</td>
                        </tr>
                     @endforeach
                    </tbody>
            </table>
            <hr>
            <h5>Subtotal <span  style="float:right; padding-right:55px">{{Cart::subtotal()}}{{$setting->currency}}</span></h5>
            <h5>Shipping Cost <span  style="float:right; padding-right:55px">{{$orderTable->shipping_cost}} {{$setting->currency}}</span></h5>
            <hr>
            @if(Session::has('coupon'))
            @if($orderTable->coupon_code)
            <h5>discount  <span  style="float:right; padding-right:55px">{{$orderTable->coupon_discount}}{{$setting->currency}}</span></h5>
            <hr>
            <h4  style="float:right; padding-right:55px" class="text-danger mb-5" >Total {{$orderTable->after_discount}} {{$setting->currency}}</h4>
            @endif
            @else
            <hr>
      
      <h4  style="float:right; padding-right:55px" class=" mb-5" >Total {{$orderTable->total}}{{$setting->currency}}</h4>
            @endif
          
        </div>
        <div class="view mt-5 mb-5">
            <p class="text-center">You can find your daily grocery on Amar Dukan.</p>
            <button class="viewbutton btn btn-outline-danger"><a href="{{route('district.show')}}">View  Your Website</a></button>
            </div>
      
        </div>
        </div>
    </section>
 
</body>
</html>