@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">




    @section('content')
    @if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
@endif
	<div class="home mt-5 mb-5">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Order Tracking</h2>
		</div>
	</div>

	<div class="shop mb-5">
		<div class="container mb-5">
			
		<h4 class="mt-1">Order #{{$order->order_id}} Details</h4>
		<div class="row justify-content-center mt-5">
		      
			  <div class="col-md-12">
				  <div class="card">
					  <div class="card-header">
						  My Order
					  </div>
					  
					  <div class="card-body">
						 <div>
							 <table class="table">
							   <thead>
								 <tr>
								   <th scope="col">SL</th>
								   <th scope="col">Product Image</th>
								   <th scope="col">Product Name</th>
								   <th scope="col">Weight\Quantity</th>
								   <th scope="col">Qty</th>
								   <th scope="col">Price</th>
								   <th scope="col">Subtotal</th>
								   <th scope="col">Item Status</th>
								 </tr>
							   </thead>
							   <tbody>
								@foreach($order_details as $key=>$row)
								 <tr>
								   <th scope="row">{{ ++$key }}</th>
								   <td>
								   <div style="max-width: 70px; max-height:70px;overflow:hidden">
							<img src="{{asset('storage/files/products/'.$row->product->thumbnail)}}" class="img-fluid img-rounded" alt="">
							</div>
								   </td>
						  
						
								   <td>{{ $row->product_name  }}</td>
								   <td>{{ $row->weight }}</td>
								   <td>{{ $row->quantity }}</td>
								   <td>{{ $row->single_price }} {{ $setting->currency }}</td>
								   <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
								   <td>{{ $row->item_status }}</td>
								 </tr>
								@endforeach 
							   </tbody>
							 </table>
						 </div>
					  </div>

					  

				  </div>
			  </div>
		  </div>
   
					<h4 class="mt-3">Order Summery</h4>
<div class="card">
<div class="pl-3 pt-2">
                    <p  style="padding-left:10px;">Subtotal: <span style="float:right; padding-right:10px">{{$order->subtotal}}{{$setting->currency}}</span></p>
                    <p style="padding-left:10px;">Tax:<span style="float:right; padding-right:10px"> 00.00 %</span> </p>
                    <p style="padding-left:10px;">Shipping Cost:<span style="float:right; padding-right:10px">{{$order->shipping_cost}}{{$setting->currency}}</span> </p>
                    @if($order->coupon_code!==NULL)
                    <p style="padding-left:10px;" class="text-dark">Coupon Discount:<span style="float:right; padding-right:10px">{{$order->coupon_discount}}</span> </p>
                    <p style="padding-left:10px;" class="text-dark">Total:<span style="float:right; padding-right:10px">{{$order->after_discount}}{{$setting->currency}}</span> </p>
                    @else
                    <p style="padding-left:10px;" class="text-dark">Total:<span style="float:right; padding-right:10px">{{$order->total}}{{$setting->currency}}</span> </p>

                    @endif
                    
                </div><hr>
</div>
<div class="row orderdetails mt-4">
                        <div class="col-md-6 col">
                        <h4 class="text-center">Order Information</h4>
                          <div class="ordercontent">
                   
                            <p>Order Id:{{ $order->order_id }}</p>
							<p>Shop Name:{{ $order->shop_name }}</p>
                            <p>Payment Type:{{ $order->payment_type }}</p>
                            <p>Order Date:{{ date('d F Y'),strtotime($order->date)}}</p>
                            <p>Order Status: @if($order->status==0)
                                 <span class="badge badge-danger bg-danger">Order Pending</span>
                              @elseif($order->status==1)
                                 <span class="badge badge-info bg-info">Order Recieved</span>
                              @elseif($order->status==2)
                                 <span class="badge badge-primary bg-primary">Order Shipped</span>
                              @elseif($order->status==3)
                                 <span class="badge badge-success bg-success">Order Completed</span> 
                              @elseif($order->status==4)
                                 <span class="badge badge-warning bg-warning">Order Return</span>   
                              @elseif($order->status==5)  
                                 <span class="badge badge-danger bg-danger">Order Cancel</span>
                              @endif   <br>	</p>
                          </div>

                        </div>
                        <div class="col-md-6 col">
                        <h4 class="text-center">Customer Information</h4>
                        <div class="customercontent">
                      
                          <p>Customer Name: {{ $order->c_name }}</p>
                          <p>Customer Phone: {{ $order->c_phone }}</p>
                          <P>Customer Email:{{ $order->c_email }}</P>
                          <P>Customer Address:{{ $order->c_address }},{{ $order->c_area }},{{ $order->c_city }}</P>
                        </div>
                        </div>
                    </div>
		 
		</div>
	</div>

@endsection