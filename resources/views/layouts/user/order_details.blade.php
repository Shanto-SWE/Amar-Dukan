@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">

@section('content')
@if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
<div class="container  mt-5">
  @else
  <div class="container dashboard mt-5">
@endif


    <div class="row ">
        <div class="col-md-3">
        @include('layouts.user.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
            <div class="card-header">
                    {{ __('Dashboard') }}
                    <a href="{{route('write.review')}}" style="float:right;" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Website review</a><br>
                    <br>
                    @if(Session()->has('shop'))
                    <a href="{{route('write.shop.review')}}" style="float:right;" class="btn btn-primary"><i class="fas fa-pencil-alt "></i> Shop review</a>
                    @endif
                </div>
                </div>
                @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <div class="card-body">

                <a style="float:right;margin-left:5px;" class="btn btn-success mb-3" href="{{route('my.order')}}">My Order</a>
                @if($order->status==0)
                   <a style="float:right; " class="btn btn-danger mb-5 "  href="#" data-toggle="modal" data-target="#cancelOrder" >Cancel Order</a>
                     @endif
                     @if($order->status==3)
                   <a style="float:right; " class="btn btn-primary mb-5 "  href="#" data-toggle="modal" data-target="#returnOrder" >Return Order</a>
                     @endif
                 
                 
                 
                <h4 style="padding-left:10px;" class="mb-3" >Order #{{$order->order_id}} Details</h4>
           
             
                @if (Session::has('success'))
                  <div class="alert alert-success mt-2">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                  </div>
                @endif
         
                   <div>
                       <table class="table table-bordered">
                         <thead>
                         <tr>
                         <th scope="col">Image</th>
                             <th scope="col">Product Name</th>
                             <th>Weight</th>
                             <th scope="col">Qty</th>
                             <th scope="col">Price</th>
                             <th scope="col">Subtotal</th>
                             <th scope="col">Item Status</th>
                          
                           </tr>
                         </thead>
                         <tbody>
                         @foreach($order_details as $key=>$row)
                           <tr>
                           <td>
                           <div style="max-width: 70px; max-height:70px;overflow:hidden">
                              <img src="{{asset('storage/files/products/'.$row->product->thumbnail)}}" class="img-fluid img-rounded" alt="">
                              </div>
                                </td>
                             <td>{{ $row->product_name  }}</td>
                             <td>{{ $row->product->quantity }}</td>
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
<hr>
<h4>Order Summery</h4>
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
                <!-- order summary -->
                <div class="card-body">
                    <div class="row orderdetails">
                        <div class="col-md-6 col">
                        <h4 class="text-center">Order Information</h4>
                          <div class="ordercontent">
                   
                            <p>Order Id:{{ $order->order_id }}</p>
                            <p>Shop Name:{{ $order->shop_name }}</p>
                            <p>Payment Type:{{ $order->payment_type }}</p>
                            <p>Order Date:{{$order->date}}</p>
                            <p>Order Status: @if($order->status==0)
                                 <span class="badge badge-danger bg-danger">Order Pending</span>
                              @elseif($order->status==1)
                                 <span class="badge badge-info bg-info">Order Recieved</span>
                              @elseif($order->status==2)
                                 <span class="badge badge-primary bg-primary">Order Shipped</span>
                              @elseif($order->status==3)
                                 <span class="badge badge-success bg-success">Order Delivered</span> 
                              @elseif($order->status==4)
                                 <span class="badge badge-warning bg-warning">Order Return</span>   
                              @elseif($order->status==5)  
                                 <span class="badge badge-danger bg-danger">Order Cancel</span>
                              @endif   <br>	</p>
                              @if($order->cancel_date)
                              <p>Cancel Date:{{$order->cancel_date}}</p>
                              @endif
                              @if($order->status==3)
                              <p>Delivered Date:{{$order->shipped_date}}</p>
                              @endif
                          </div>

                        </div>
                        <div class="col-md-6 col">
                        <h4 class="text-center">Shipping Information</h4>
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
        </div>
    </div>
</div><hr>
<!-- order cancel modal -->
<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{route('user.order.cancel',$order->order_id)}}" method="post" >
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reason for Cancellation</h4>
        <hr>
       
      </div>
      <div class="modal-body">
      <div class="form-group">

        <select class="form-control" name="reason" id="cancelReason"  style="min-width: 480px; margin-left: -4px;" >
          <option value="" class="text-dark">Select Reason</option>
          <option value="Order Created by Mistake">Order Created by Mistake</option>
          <option value="Item Not Arrive On Time">Item Not Arrive On Time</option>
          <option value="Shipping Cost Too High">Shipping Cost Too High</option>
          <option value="Found Cheaper Somewhere Else">Found Cheaper Somewhere Else</option>
          <option value="Other">Other</option>
  
        </select>
      </div>
      

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Cancel Order</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- return order modal -->
<div class="modal fade" id="returnOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{route('user.order.return',$order->order_id)}}" method="post" >
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reason for Returns</h4>
        <hr>
       
      </div>
      <div class="modal-body">
   
     
      <div class="form-group">

        <select class="form-control" name="product_id" id="returnProduct"  style="min-width: 480px; margin-left: -4px;" required >
          <option value="">Select Product</option>
          @foreach($order_details as $orderdatails)
          @if($orderdatails->item_status!=="Return Initiated" && $orderdatails->item_status!=="Return Rejected" &&  $orderdatails->item_status!=="Return Approved")
          
          <option value="{{$orderdatails->product_id}}">{{$orderdatails->product_name}}</option>
          @endif
          @endforeach
  
        </select>
      </div>
 
  
      <div class="form-group">

        <select class="form-control" name="returnReason" id="returnReason"  style="min-width: 480px; margin-left: -4px;" required >
          <option value="" class="text-dark">Select Reason</option>
          <option value="Performance or quality not adequate">Performance or quality not adequate</option>
          <option value="Product damaged,but shipping box Ok">Product damaged,but shipping box Ok</option>
          <option value="Item arrived too late">Item arrived too late</option>
          <option value="Wrong Item was sent">Wrong Item was sent</option>
          <option value="Item defective">Item defective</option>
        
  
        </select>
      </div>

      <div class="form-group">
       <textarea class="form-control" name="comment" placeholder="Comment"></textarea>

</div>
      

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Return Order</button>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection


 