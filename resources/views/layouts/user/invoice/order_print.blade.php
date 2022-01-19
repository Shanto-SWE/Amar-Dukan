<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}


</style>
<body>
    
<div class="container">
<div class="row">
    <div class="col-xs-6">
    <img class="mainlogo" src="{{ asset($setting->logo) }}" alt="">

    </div>
    <div class="col-xs-6 text-right">
    <h2>Amar Dukan</h2>
    <address>
    			
    {{$setting->address}}<br>
    {{$setting->phone_one}}<br>
    					{{$setting->main_email}}<br>
    				
    				</address>
    </div>
  </div>
    <div class="row">
        <div class="col-xs-12">
      
    		<div class="invoice-title">
    			<h2>Invoice To</h2><h3 class="pull-right">Order # {{$order->order_id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    			
    					{{$order->c_name}}<br>
              {{$order->c_address}}<br>
                        {{$order->c_area}},
                        {{$order->c_city}}<br>
                        {{$order->c_phone}}<br>
    					<span class="text-primary">{{$order->c_email}}</span><br>
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
          <address>
    					<strong>Order Date:</strong>
                        {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}<br>
                        <strong>Order Status:</strong>
                              @if($order->status==0)
                                 Pendding<br>
                                 @elseif($order->status==1)
                                Recieved<br>
                                @elseif($order->status==2)
                                Shipped<br>

                                @elseif($order->status==3)
                                Completed<br>
                                @elseif($order->status==4)
                                Return<br>
                                @else
                                Cancel<br>
                                @endif
                                <strong>Payment Method:</strong>
                                {{$order->payment_type}}<br>
                                <strong>Shop Name:</strong>
                                {{$order->shop_name}}<br>
    				</address>
    			</div>
    		</div>
    	
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        				
        							<td class="text-center"><strong>Product Image</strong></td>
        							<td class="text-center"><strong>Product Name</strong></td>
        							<td class="text-right"><strong>Product Weight/Quantity</strong></td>
                                    <td class="text-right"><strong>QtyxPrice</strong></td>
                                    <td class="text-right"><strong>Subtotal</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                            @foreach($order_details as $row)
                           <tr>
						   <td>
                            <div style="max-width: 50px; max-height:50px;overflow:hidden">
                              <img src="{{asset('storage/files/products/'.$row->product->thumbnail)}}" class="img-fluid img-rounded" alt="">
                              </div>
                                </td>
                             <td scope="row">{{ $row->product_name }}</td>
                             <td scope="row">{{ $row->product->quantity }}</td>
                             <td>{{ $row->quantity }} x {{ $row->single_price }} {{ $setting->currency }}</td>
                             <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
                          
                           </tr>
                          @endforeach 
                       
    							<tr>
                                <td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line "><strong>Subtotal</strong></td>
    								<td class="thick-line ">{{$order->subtotal}}{{ $setting->currency }}</td>
    							</tr>
                                @if($order->coupon_code!==Null)
                                <tr>
                                <td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Coupon Code</strong></td>
    								<td class="no-line ">{{$order->coupon_code}}</td>
    							</tr>
    							<tr>
                                <tr>
                                <td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Coupon Discount</strong></td>
    								<td class="no-line ">{{$order->coupon_discount}}</td>
    							</tr>
    							<tr>

                                @endif
    							<tr>
                                <td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Shipping</strong></td>
    								<td class="no-line ">{{$order->shipping_cost}}.00 {{ $setting->currency }}</td>
    							</tr>
                                @if($order->coupon_code!==Null)
    							<tr>
                                <td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Total</strong></td>
    								<td class="no-line ">{{$order->after_discount}}{{ $setting->currency }}</td>
    							</tr>
                                @else
                                <tr>
                                <td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Total</strong></td>
    								<td class="no-line ">{{$order->total}}{{ $setting->currency }}</td>
    							</tr>
                                @endif
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>