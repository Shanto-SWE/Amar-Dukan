<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    </style>
</head>
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
    			<h2>Invoice To</h2><h3 class="pull-right text-primary">Request Order # {{$request_order->request_id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					{{$request_order->name}}<br>
						{{$request_order->delivery_address}}<br>
                        {{$request_order->delivery_area}},
                        {{$request_order->city}}<br>
    					{{$request_order->phone}}<br>
						<span class="text-primary">{{$request_order->email}}</span><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
				<address>
    					<strong>Order Date:</strong>
						{{ \Carbon\Carbon::parse($request_order->date)->format('d/m/Y')}}<br>
						<strong>Order Status:</strong>
                              @if($request_order->status==0)
                                 Pendding<br>
                                 @elseif($request_order->status==1)
                                Recieved<br>
                                @elseif($request_order->status==2)
                                Shipped<br>

                                @elseif($request_order->status==3)
                                Completed<br>
                                @elseif($request_order->status==4)
                                Return<br>
                                @else
                                Cancel<br>
                                @endif
                                <strong>Payment Method:</strong>
                           HandCash<br>
                                <strong>Shop Name:</strong>
                                {{$request_order->shop->shop_name}}<br>
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
        							<td><strong>Product Photo</strong></td>
        							<td ><strong>Name</strong></td>
        							<td ><strong>Origin</strong></td>
        							<td ><strong>Weight</strong></td>
									<td ><strong>Quantity</strong></td>
									<td ><strong>Sub Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
							<tr>
						   <td>
                            <div style="max-width: 50px; max-height:50px;overflow:hidden">
                              <img src="{{asset($request_order->product_photo)}}" class="img-fluid img-rounded" alt="">
                              </div>
                                </td>
                             <td scope="row">{{ $request_order->product_name }}</td>
                             <td scope="row">{{ $request_order->product_origin }}</td>
							 <td scope="row">{{ $request_order->product_weight }}</td>
							 <td scope="row">{{ $request_order->product_quantity }}</td>
							 <td scope="row">{{ number_format($request_order->subtotal_price, 2) }}{{$setting->currency}}</td>
                             
                          
                           </tr>
                               
    							<tr>
								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
									<td class="thick-line"></td>
    								<td class="thick-line "><strong>Subtotal</strong></td>
    								<td class="thick-line ">{{ number_format($request_order->subtotal_price, 2) }}{{$setting->currency}}</td>
    							</tr>
    							<tr>
								<td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
									<td class="thick-line"></td>
    								<td class="no-line "><strong>Shipping</strong></td>
    								<td class="no-line ">{{ number_format($request_order->shipping_cost, 2) }}{{$setting->currency}}</td>
    							</tr>
    							<tr>
								<td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
									<td class="thick-line"></td>
    								<td class="no-line "><strong>Total</strong></td>
    								<td class="no-line ">{{ number_format($request_order->total_price, 2) }}{{$setting->currency}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</body>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>