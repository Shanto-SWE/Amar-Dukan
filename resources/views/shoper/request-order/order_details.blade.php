
@extends('layouts.shoper')
@section('shoper_content')

  

<div class="content-wrapper">
  
  <div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
		<div class="col-sm-6">
		  <h1 class="mb-4">Request Orders {{$requestOrder->request_id}} Details</h1>
		</div>
		<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('admin.request-order.index') }}" class="btn btn-primary" >Back Order</a>
            
	  </div>
	</div>
  </div>
 
<div class="row orderdetails  ">
	<div class="col-md-5 mx-5 orderde ">
      <div class="order_details px-3">
	  <h5 class="mt-2">Order Details</h5>
	   <hr>
	  <p>Request Order ID: <span  style="float:right; padding-right:10px;color:red;">{{$requestOrder->request_id}}</span></p><hr>
	  <p>Order Date: <span  style="float:right; padding-right:10px">{{$requestOrder->date}}</span></p><hr>
	  <p>Delivery Date: <span  style="float:right; padding-right:10px">{{$requestOrder->delivery_date}}</span></p><hr>
	  <p>Shop Name: <span  style="float:right; padding-right:10px">{{$requestOrder->shop->shop_name}}</span></p><hr>
	  <p>Subtotal: <span  style="float:right; padding-right:10px">{{ number_format($requestOrder->subtotal_price, 2) }}{{$setting->currency}}</span></p><hr>
	  <p>Shipping Cost: <span  style="float:right; padding-right:10px">{{ number_format($requestOrder->shipping_cost, 2) }}{{$setting->currency}}</span></p><hr>
	
	  <p>Total: <span  style="float:right; padding-right:10px">{{ number_format($requestOrder->total_price, 2) }}{{$setting->currency}}</span></p><hr>
	  <p>Order Status: <span  style="float:right; padding-right:10px">

	  @if($requestOrder->status==0)
	  Pedding
	  @elseif($requestOrder->status==1)
	  Recieved
	  @elseif($requestOrder->status==2)
	  Shipped
	  @elseif($requestOrder->status==3)
	  Completed
	  @elseif($requestOrder->status==4)
	  Return
	  @else($requestOrder->status==5)
	  Cancel

	  @endif

	</span></p><hr>


	  </div>
	  <div class="deliver_address px-3 mt-4 ">
	  <h5 class="mt-2">Delivery Address</h5>
	<hr>
	  <p>Customer Name: <span  style="float:right; padding-right:10px">{{$requestOrder->name}}</span></p><hr>
	  <p>Email: <span  style="float:right; padding-right:10px">{{$requestOrder->email}}</span></p><hr>
	  <p>Phone: <span  style="float:right; padding-right:10px">{{$requestOrder->phone}}</span></p><hr>
	  <p>Delivery Zone: <span  style="float:right; padding-right:10px">{{$requestOrder->city}}</span></p><hr>
	  <p>Delivery Area: <span  style="float:right; padding-right:10px">{{$requestOrder->delivery_area}}</span></p><hr>
	  <p>Delivery Address: <span  style="float:right; padding-right:10px">{{$requestOrder->delivery_address}}</span></p><hr>
	  
	  </div>
	</div>
	<div class="col-md-5 customerdetails">
	
<div class="customer_details px-3 ">
<h5 class="mt-2">Customer Details</h5>
	<hr>
<p>Customer Name: <span  style="float:right; padding-right:10px">{{$requestOrder->user->FullName}}</span></p><hr>
	<p>Customer Email: <span  style="float:right; padding-right:10px">{{$requestOrder->user->email}}</span></p><hr>

</div>
	<div class="billing_address mt-4 px-3">
	<h5 class="mt-2">Billing Address</h5>
	<hr>
	<p>Customer Name: <span  style="float:right; padding-right:10px">{{$requestOrder->user->FullName}}</span></p><hr>
	<p>Delivery Zone: <span  style="float:right; padding-right:10px">{{$requestOrder->user->delivery_zone}}</span></p><hr>
	<p>Delivery Area: <span  style="float:right; padding-right:10px">{{$requestOrder->user->delivery_area}}</span></p><hr>
	<p>Delivery Address: <span  style="float:right; padding-right:10px">{{$requestOrder->user->delivery_address}}</span></p><hr>
	<p>Phone: <span  style="float:right; padding-right:10px">{{$requestOrder->user->phone}}</span></p><hr>
	
	</div>
	<div class="update_status mt-4 px-3">
	<h5 class="mt-2">Update Order Status & Price</h5>
	<hr>

	<div class="form-group">
	<input type="hidden" name="id" value="{{ $requestOrder->id }}">
            <select class="form-control" name="status" >
      		 	  
						<option value="0" @if($requestOrder->status==0) selected @endif>Pedding</option>
						<option value="1" @if($requestOrder->status==1) selected @endif>Recieved</option>
						<option value="2" @if($requestOrder->status==2) selected @endif>Shipped</option>
						<option value="3" @if($requestOrder->status==3) selected @endif>Completed</option>
						<option value="4" @if($requestOrder->status==4) selected @endif>Return</option>
						<option value="5" @if($requestOrder->status==5) selected @endif>Cancel</option>
      		 </select>
          </div>  
		 
	
      <div class="modal-footer">
      
      </div>
	 
 <!-- order history -->
 @foreach($order_history as $history)
	  <p class="orderhistory">
		  @if($history->order_status==0)
		  <b>Pending</b>
		  @elseif($history->order_status==1)
		  <b>Recieved</b>
		  @elseif($history->order_status==2)
		  <b>Shipped</b>

		  @elseif($history->order_status==3)
		  <b>Completed</b>
		  @elseif($history->order_status==4)
		  <b>Return</b>
		  @elseif($history->order_status==5)
		  <b>Cancel</b>
		  @else
		  <b>User Cancel</b>
		  @endif
		  <br>
		  @if(($history->reason!==Null))
		  <p style="margin-bottom:0;">{{$history->reason}}</p>
		  @endif
         <small><b>{{date('j F,Y, g:i:a',strtotime($history->time))}}</b></small></p>
	  <br>
	  @endforeach
	
	</div>
	</div>
	

</div>
</div>

<div class="row order_product mt-4 mx-5">
<h5 class="mt-2 mx-3">Ordered Product</h5>
<hr>
	<div class="col-md-12 ">
	<table class="table mt-3 viewordertable">
                         <thead>
                           <tr>
						   <th scope="col">Product Image</th>
                             <th scope="col">Product Name</th>
							 <th scope="col">Origin</th>
                             <th scope="col">Product Weight</th>
                             <th scope="col">Product Quantity</th>
                             <th scope="col">Product Description</th>
							
                          
                    
                           </tr>
                         </thead>
                         <tbody>
                   
                           <tr>
						   <td>
                            <div style="max-width: 50px; max-height:50px;overflow:hidden">
                              <img src="{{asset($requestOrder->product_photo)}}" class="img-fluid img-rounded" alt="">
                              </div>
                                </td>
                             <td scope="row">{{ $requestOrder->product_name }}</td>
							 <td scope="row">{{ $requestOrder->product_origin }}</td>
                             <td scope="row">{{ $requestOrder->product_weight }}</td>
							 <td scope="row">{{ $requestOrder->product_quantity }}</td>
							 <td scope="row">{{ $requestOrder->product_description }}</td>
						
                          
                           </tr>
                   
                         </tbody>
                       </table>
		
	</div>
</div>

@endsection