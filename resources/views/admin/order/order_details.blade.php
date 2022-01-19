

@extends('layouts.admin')

@section('title','Order_Details')
@section('admin_content')
  

<div class="content-wrapper">
  
  <div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
		<div class="col-sm-6">
		  <h1 class="m-0">Orders #{{$order->order_id}}  Details</h1>
		</div>
		<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('admin.order.index') }}" class="btn btn-primary" >Back Order</a>
            
	  </div>
	</div>
  </div>
 
<div class="row orderdetails mt-4 ">
	<div class="col-md-5 mx-5 orderde ">
      <div class="order_details px-3">
	  <h5 class="mt-2">Order Details</h5>
	   <hr>
	  <p>Order ID: <span  style="float:right; padding-right:10px;color:red;">{{$order->order_id}}</span></p><hr>
	  <p>Order Date: <span  style="float:right; padding-right:10px">{{$order->date}}</span></p><hr>
	  <p>Shop Name: <span  style="float:right; padding-right:10px">{{$order->shop_name}}</span></p><hr>
	  <p>Order Status: <span  style="float:right; padding-right:10px">
	
	  @if($order->status==0)
	  Pending
	  @elseif($order->status==1)
	  Recieved
	  @elseif($order->status==2)
	  Shipped
	  @elseif($order->status==3)
	  Completed
	  @elseif($order->status==4)
	  Return
	  @else($order->status==5)
	  Cancel

	  @endif

	</span></p><hr>
	@if($order->shipped_date)
	  <p>Shipped Date: <span  style="float:right; padding-right:10px">{{$order->shipped_date}}</span></p><hr>

	  @endif
	  <p>SubTotal: <span  style="float:right; padding-right:10px">{{$order->subtotal}}{{$setting->currency}}</span></p><hr>
	  <p>Shipping charge: <span  style="float:right; padding-right:10px">{{$order->shipping_cost}}{{$setting->currency}}</span></p><hr>
	<p>Order Total: <span  style="float:right; padding-right:10px">{{$order->total}}{{$setting->currency}}</span></p><hr>
	  @if($order->coupon_code)
	  <p>Coupon Discount: <span  style="float:right; padding-right:10px">{{$order->coupon_discount}}</span></p><hr>
	  <p>Coupon Code: <span  style="float:right; padding-right:10px">{{$order->coupon_code}}</span></p><hr>
	  <p>After Discount: <span  style="float:right; padding-right:10px">{{$order->after_discount}}{{$setting->currency}}</span></p><hr>
	  @else
	  <p>Coupon Discount: <span  style="float:right; padding-right:10px">0.00</span></p><hr>
	  <p>Coupon Code: <span  style="float:right; padding-right:10px">0.00</span></p><hr>
	  <p>After Discount: <span  style="float:right; padding-right:10px">0.00</span></p><hr>
      @endif
	  <p>Payment Method: <span  style="float:right; padding-right:10px">{{$order->payment_type}}</span></p><hr>
	
	  </div>
	  <div class="deliver_address px-3 mt-4 ">
	  <h5 class="mt-2">Delivery Address</h5>
	<hr>
	  <p>Customer Name: <span  style="float:right; padding-right:10px">{{$order->c_name}}</span></p><hr>
	  <p>Email: <span  style="float:right; padding-right:10px">{{$order->c_email}}</span></p><hr>
	  <p>Phone: <span  style="float:right; padding-right:10px">{{$order->c_phone}}</span></p><hr>
	  <p>Delivery Zone: <span  style="float:right; padding-right:10px">{{$order->c_city}}</span></p><hr>
	  <p>Delivery Area: <span  style="float:right; padding-right:10px">{{$order->c_area}}</span></p><hr>
	  <p>Delivery Address: <span  style="float:right; padding-right:10px">{{$order->c_address}}</span></p><hr>
	  
	  </div>
	</div>
	<div class="col-md-5 customerdetails">
	
<div class="customer_details px-3 ">
<h5 class="mt-2">Customer Details</h5>
	<hr>
<p>Customer Name: <span  style="float:right; padding-right:10px">{{$order->user->FullName}}</span></p><hr>
	<p>Customer Email: <span  style="float:right; padding-right:10px">{{$order->user->email}}</span></p><hr>

</div>
	<div class="billing_address mt-4 px-3">
	<h5 class="mt-2">Billing Address</h5>
	<hr>
	<p>Customer Name: <span  style="float:right; padding-right:10px">{{$order->user->FullName}}</span></p><hr>
	<p>Delivery Zone: <span  style="float:right; padding-right:10px">{{$order->user->delivery_zone}}</span></p><hr>
	<p>Delivery Area: <span  style="float:right; padding-right:10px">{{$order->user->delivery_area}}</span></p><hr>
	<p>Delivery Address: <span  style="float:right; padding-right:10px">{{$order->user->delivery_address}}</span></p><hr>
	<p>Phone: <span  style="float:right; padding-right:10px">{{$order->user->phone}}</span></p><hr>
	
	</div>
	<div class="update_status mt-4 px-3">
	<h5 class="mt-2">Update Order Status</h5>
	<hr>
	<form action="{{ route('update.change.status') }}" method="Post" >
	@csrf
	<div class="form-group">
	
	<input type="hidden" name="id" value="{{ $order->id }}">
            <select class="form-control" name="status" id="status">
      		 	    <option value="0" @if($order->status==0) selected @endif>Pending</option>
						<option value="1" @if($order->status==1) selected @endif>Recieved</option>
						<option value="2" @if($order->status==2) selected @endif>Shipped</option>
						<option value="3" @if($order->status==3) selected @endif>Completed</option>
						<option value="4" @if($order->status==4) selected @endif>Return</option>
						<option value="5" @if($order->status==5) selected @endif>Cancel</option>
      		 </select>
          </div>
		  @if($order->status==2)
		 
		 <div class="delivery ">
			 @else
			 <div class="delivery d-none">
				 @endif
		 <div class="from-group">
		  <label for="name">Delivery Man Name</label>
		  @if($single_history)
			  <input type="text " name="deleverManName"  value="{{$single_history->delivery_man_name}}"  class="form-control" placeholder="name">
			  @else
			  <input type="text " name="deleverManName"    class="form-control" placeholder="name">
			  @endif
		  </div>   
		  <div class="from-group">
		  <label for="phone">Delivery Man Phone</label>
		  @if($single_history)
			  <input type="number" name="deleverManPhone"   value="{{$single_history->delivery_man_phone}}"  class="form-control" placeholder="Phone">
			  @else
			  <input type="number" name="deleverManPhone"    class="form-control" placeholder="Phone">
			  @endif

		  </div>
		 </div>   
	
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"><span class="loader d-none">..Loading</span>  Update</button>
      </div>
	  </form>
	  <!-- order history -->
       @foreach($order_history as $history)
	  <p class="orderhistory" >
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
		  <p style="margin-bottom:0;" >{{$history->reason}}</p>
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
							 <th scope="col">Product Code</th>
                             <th scope="col">Product Weight/Quantity</th>
                             <th scope="col">QtyxPrice</th>
                             <th scope="col">Subtotal</th>
							 <th scope="col">Item Status</th>
                          
                    
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
							 <td scope="row">{{ $row->product->code }}</td>
                             <td scope="row">{{ $row->product->quantity }}</td>
                             <td>{{ $row->quantity }} x {{ $row->single_price }} {{ $setting->currency }}</td>
                             <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
							 <td scope="row">{{ $row->item_status }}</td>
                           </tr>
                          @endforeach 
                         </tbody>
                       </table>
		
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $("#status").change(function(){
	  var status=$("#status").val();
	 if(status==2){
        $('.delivery').removeClass('d-none');
	 }
	
    
   
        });

</script>

@endsection