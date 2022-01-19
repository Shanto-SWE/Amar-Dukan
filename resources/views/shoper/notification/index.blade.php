@extends('layouts.shoper')
@section('shoper_content')
<div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Notification</h1>
          </div>
         
        </div>
      </div>
    </div>
    <hr>
  
<div class="row">
    <div class="col-md-12">
      @php
         $shop=Session::get('shoper');
         $shop_id=$shop->id;

      $notifi=DB::table('shoper_notifications')->where('shop_id',$shop_id)->first();
      @endphp
    
    @if($notifi)
    @foreach($notification as $key=>$row)
    @if($row->seen==1)
        <div class="notification notificationcolor mx-4 mt-2">
          @else
          <div class="notification mx-4 mt-2">
            @endif
      <p class="adminnotification" ><i class="fas fa-envelope mb-0"></i> {{$row->data}}</p>
    <small>{{Carbon\Carbon::parse($row->time)->diffForHumans()}}</small>
        </div>
        @endforeach
        <div class="clear mt-5 mx-4">
        <a href="{{route('shoper.clear.notification')}}"><button class="btn btn-danger">Clear All</button></a>
        </div>
        @else
        <h4 class="text-center">No Notification Found</h4>
      @endif
    </div>

   
</div>


</div>

@endsection
