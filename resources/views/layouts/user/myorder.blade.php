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

                <div class="card-body">
                   
                <h4 style="padding-left:10px;">My All Orders</h4>
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
                       <table class="table">
                         <thead>
                         <tr>
                           <th scope="col">OrderId</th>
                             <th scope="col">Date</th>
                             <th scope="col">Total</th>
                             <th scope="col">Discount Price</th>
                             <th scope="col">Status</th>
                             <th scope="col">Action</th>
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
                                 <span class="badge badge-danger bg-danger">Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info bg-info">Recieved</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary bg-primary">Shipped</span>
                              @elseif($row->status==3)
                                 <span class="badge badge-success bg-success">Delivered</span> 
                              @elseif($row->status==4)
                                 <span class="badge badge-warning bg-warning">Return</span>   
                              @elseif($row->status==5)  
                                 <span class="badge badge-danger bg-danger">Cancel</span>
                              @endif          
                            </td>
                            <td>
                            @if($row->status==1||$row->status==2||$row->status==3)
                            	<a href="{{route('view.order',$row->id)}}" class="btn btn-sm btn-primary" title="view order"><i class="fa fa-eye"></i></a>
                              @endif
                               <a href="#" class="btn btn-sm btn-primary orderPrint" data-id="{{$row->id}}" title="print invoice"><i class="fas fa-file-pdf"></i></a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	

  $('body').on('click','.orderPrint', function(){
    var id=$(this).data('id');
    var url = "{{ url('user/order/print') }}/"+id;

    $.ajax({
	url:url,
	type:'get',
	success:function(data){
	  $(data).printThis({
			   debug:false,
			   importCSS:true,
			   importStyle:true,
			   removeInline:false,
			   printDelay:500,
			   header:null,
			   footer:null,

	  });

	}
});
  });



</script>
@endsection

