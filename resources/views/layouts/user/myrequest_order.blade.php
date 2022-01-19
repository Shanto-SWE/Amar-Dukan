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
        <div class="col-md-4">
        @include('layouts.user.sidebar')
        </div>
        <div class="col-md-8">
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
                <div class="card-body">
                <a style="float:right;margin-left:5px;" class="btn btn-success mb-3" href="{{route('request.order')}}" >My Order</a>
                @if($requestorder->status==0)
                <a style="float:right; " class="btn btn-danger mb-5 "  href="#" data-toggle="modal" data-target="#cancelRequestOrder" >Cancel Order</a>
              
                     @endif
                     @if($requestorder->status==3)
                <a style="float:right; " class="btn btn-primary mb-5 "  href="#" data-toggle="modal" data-target="#returnRequestOrder" >Return Order</a>
              
                     @endif
                   
                   <h4 style="padding-left:10px;">My Orders #{{ $requestorder->request_id }} Details</h4>
                      <div>
                      @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                  <div class="alert alert-success  mt-3 mb-3">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                  </div>
                @endif
                          <table class="table">
                            <thead>
                            <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Product Photo</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Origin</th>
                                <th scope="col">Product Weight</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Item Status</th>
                               
                        
                        
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details as $key=>$row)
                              <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>
                                   <div style="max-width: 60px; max-height:60px;overflow:hidden">
                                     <img src="{{asset($row->product_photo)}}" class="img-fluid img-rounded" alt="">
                                     </div>
                                  </td>
                                <td>{{ $row->product_name  }}</td>
                                <td>{{ $row->product_origin }}</td>
                                <td>{{ $row->product_weight }}</td>
                                <td>{{ $row->product_quantity }} </td>
                                <td>{{ $row->item_status }} </td>
                               
                              </tr>
                             @endforeach 
                            </tbody>
                          </table>
                      </div>
                   </div>
              
              
                <h4>Order Summery</h4>
              <div class="card">
            <div class="pl-3 pt-2">
                    <p  style="padding-left:10px;">Subtotal: <span style="float:right; padding-right:10px">{{ number_format($requestorder->subtotal_price, 2) }}{{$setting->currency}}</span></p>
                    <p style="padding-left:10px;">Tax:<span style="float:right; padding-right:10px"> 00.00 %</span> </p>
                    <p style="padding-left:10px;">Shipping Cost:<span style="float:right; padding-right:10px">{{ number_format($requestorder->shipping_cost, 2) }}{{$setting->currency}}</span> </p>
                    
                    <p style="padding-left:10px;" class="text-dark">Total:<span style="float:right; padding-right:10px">{{ number_format($requestorder->total_price, 2) }}{{$setting->currency}}</span> </p>

                  
                    
                </div><hr>
</div>

<div class="card-body">
               
               <div class="row orderdetails">
                   <div class="col-md-6 col">
                   <h4 class="text-center">Order Information</h4>
                     <div class="ordercontent">
              
                       <p>Order Id:{{ $requestorder->request_id }}</p>
                       
                       <p>Shop Name:{{ $requestorder->shop->shop_name }}</p>
                       <p>Order Date:{{ date('d F Y'),strtotime($requestorder->delivery_date)}}</p>
                       <p>Order Status:
                       @if($requestorder->status==0)
                            <span class="badge badge-info bg-danger">Pendding</span>
                         @elseif($requestorder->status==1)
                            <span class="badge badge-info bg-info">Recieved</span>
                         @elseif($requestorder->status==2)
                            <span class="badge badge-primary bg-primary">Shipped</span>
                         @elseif($requestorder->status==3)
                            <span class="badge badge-success bg-success">Completed</span> 
                         @elseif($requestorder->status==4)
                            <span class="badge badge-warning bg-warning">Return</span>   
                         @elseif($requestorder->status==5)  
                            <span class="badge badge-danger bg-danger">Cancel</span>
                         @endif   <br>	</p>
                     </div>

                   </div>
                   <div class="col-md-6 col">
                   <h4 class="text-center">Customer Information</h4>
                   <div class="customercontent">
                 
                     <p>Customer Name: {{ $requestorder->name }}</p>
                     <p>Customer Phone: {{ $requestorder->phone }}</p>
                     <P>Customer Email:{{ $requestorder->email }}</P>
                     <P>Customer Address:{{ $requestorder->delivery_address }},{{ $requestorder->delivery_area }},{{ $requestorder->city }}</P>
                   </div>
                   </div>
               </div>
 
     
           </div>

             
            </div>
        </div>
    </div>
</div><hr>
<!-- request order cancel modal -->
<div class="modal fade" id="cancelRequestOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{route('user.request-order.cancel',$requestorder->id)}}" method="post" >
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Cancellation</h5>
       
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

<!-- request order return modal -->
<div class="modal fade" id="returnRequestOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{route('user.requestOrder.return',$requestorder->id)}}" method="post" >
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reason for Returns</h4>
        <hr>
       
      </div>
      <div class="modal-body">
   
 
  
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
      <div class="form-group mt-3">
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
