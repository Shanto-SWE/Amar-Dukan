@extends('layouts.admin')

@section('title','District')
@section('admin_content')
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
      $notifi=DB::table('admin_notifications')->first();
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
        <a href="{{route('clear.notification')}}"><button class="btn btn-danger">Clear All</button></a>
        </div>
        @else
        <h4 class="text-center">No Notification Found</h4>
      @endif
    </div>

   
</div>


</div>

@endsection
