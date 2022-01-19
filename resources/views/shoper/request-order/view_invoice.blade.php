<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
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


    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
 
         
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Request Order # {{$request_order->request_id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$request_order->name}}<br>
                        {{$request_order->email}}<br>
    					{{$request_order->phone}}<br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
                    {{$request_order->name}}<br>
    				{{$request_order->delivery_address}}<br>
                    {{$request_order->delivery_area}}<br>
                    {{$request_order->city}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    				    HandCash<br>
                     
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
                        {{ \Carbon\Carbon::parse($request_order->date)->format('d/m/Y')}}<br>
    				
                    <strong>Delivery Date:</strong><br>
                    {{ \Carbon\Carbon::parse($request_order->delivery_date)->format('d/m/Y')}}<br>
                    <strong>Order Status:</strong><br>
                              @if($request_order->status==0)
                                 Pendding<br><br>
                                 @elseif($request_order->status==1)
                                Recieved<br><br>
                                @elseif($request_order->status==2)
                                Shipped<br><br>

                                @elseif($request_order->status==3)
                                Completed<br><br>
                                @elseif($request_order->status==4)
                                Return<br><br>
                                @else
                                Cancel<br><br>
                                @endif
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
        					
        							<td ><strong>Name</strong></td>
        							<td ><strong>Origin</strong></td>
        							<td ><strong>Weight</strong></td>
									<td ><strong>Quantity</strong></td>
                                    <td ><strong>Sub Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
							<tr>
						   
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
    								<td class="thick-line "></td>
    								<td class="thick-line" ></td>
    							</tr>
								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line "><strong>Subtotal</strong></td>
    								<td class="thick-line" >{{ number_format($request_order->subtotal_price, 2) }}{{$setting->currency}}</td>
    							</tr>
    							<tr>
								<td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line "><strong>Shipping Cost</strong></td>
    								<td class="no-line ">{{ number_format($request_order->shipping_cost, 2) }}{{$setting->currency}}</td>
    							</tr>
    							<tr>
								<td class="thick-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
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