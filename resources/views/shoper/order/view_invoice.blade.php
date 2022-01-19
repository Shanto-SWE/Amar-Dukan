<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
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
    
<div class="container ">
    <div class="row">
        <div class="col-xs-12">
      
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$order->order_id}}</h3>
                <br>
                <span class="pull-right">
				<?php
				echo DNS1D::getBarcodeHTML($order->order_id, 'C39');
				?>

			</span>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$order->c_name}}<br>
                        {{$order->c_phone}}<br>
    					{{$order->c_email}}<br>
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$order->c_name}}<br>
    					{{$order->c_address}}<br>
                        {{$order->c_area}}<br>
                        {{$order->c_city}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$order->payment_type}}<br>
            
    	
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
                        {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}<br><br>
                        <strong>Order Status:</strong><br>
                              @if($order->status==0)
                                 Pendding<br><br>
                                 @elseif($order->status==1)
                                Recieved<br><br>
                                @elseif($order->status==2)
                                Shipped<br><br>

                                @elseif($order->status==3)
                                Completed<br><br>
                                @elseif($order->status==4)
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
        				
        						
        							<td ><strong>Product Name</strong></td>
                                    <td ><strong>Product Code</strong></td>
        							<td><strong>Product Weight/Quantity</strong></td>
                                    <td><strong>QtyxPrice</strong></td>
                                    <td><strong>Subtotal</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                            @foreach($order_details as $row)
                           <tr>
						   
                             <td scope="row">{{ $row->product_name }}
                             <br>
                                 <br>
                             <span >
				<?php
				echo DNS1D::getBarcodeHTML($row->product->code, 'C39');
				?>

			</span>
                             </td>
                             <td scope="row">{{ $row->product->code }}</td>
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
    								<td class="no-line "><strong>Shipping Cost</strong></td>
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