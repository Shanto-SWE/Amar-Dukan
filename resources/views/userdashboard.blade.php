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

    <div class="row justify-content-center mt-5">
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

                <div class="card-body">
                   <div class="row">
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-success">Total Order</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $total_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-success">Order Complete</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $complete_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-danger">Cancel Order</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $cancel_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       <div class="col-lg-3">
                          <a href=""> 
                            <div class="card" >
                              <div class="card-body">
                                <h5 class="card-title text-warning">Return Order</h5>
                                <h6 class="card-subtitle mb-2 text-muted text-center">{{ $return_order }}</h6>
                              </div>
                            </div>
                          </a>
                       </div>
                   </div><br>
                   <h4  style="padding-left:10px;">Recent Order</h4>
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                           <th scope="col">OrderId</th>
                           <th scope="col">Date</th>
                             <th scope="col">Total</th>
                             <th scope="col">Discount Price</th>
                             <th scope="col">Status</th>
                           </tr>
                         </thead>
                         <tbody>
                         @foreach($orders as $row)
                           <tr>
                             <th scope="row">{{ $row->order_id }}</th>
                             <td>{{ date('d F , Y', strtotime($row->date)) }}</td>
                             <td>{{ $row->total }} {{ $setting->currency }}</td>
                             @if( $row->after_discount )
                             <td>{{ $row->after_discount }} {{ $setting->currency }}</td>
                             @else
                             <td>0.00{{ $setting->currency }}</td>
                             @endif
                    
                             <td>
                              @if($row->status==0)
                                 <span class="badge badge-danger bg-danger">Order Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info bg-info">Order Recieved</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary bg-primary">Order Shipped</span>
                              @elseif($row->status==3)
                                 <span class="badge badge-success bg-success">Order Delivered</span> 
                              @elseif($row->status==4)
                                 <span class="badge badge-warning bg-warning">Order Return</span>   
                              @elseif($row->status==5)  
                                 <span class="badge badge-danger bg-danger">Order Cancel</span>
                              @endif          
                            </td>
                            
                           </tr>
                          @endforeach 
                        
                         
                         </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
