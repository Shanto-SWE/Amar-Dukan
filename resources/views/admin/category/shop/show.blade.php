@extends('layouts.admin')

@section('title','Shop_view')
@section('admin_content')

<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Shop view of {{$shop->shop_name}} </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <a href="{{ route('shop.index') }}" class="btn btn-primary" >Shop</a>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container" style="padding-left:30px;">
    <div class="row">
        <div class="col-md-12 productview ">
    <table class="">
    <tr>
    <td>Shop Photo:</td>
           
           <td>
            <div style="max-width: 150px; max-height:150px">
            <img src="{{ asset($shop->shop_photo) }}" class="img-fluid img-rounded" alt="">
            </div>
            </td>
        </tr>
        <tr>
            <td>Shop Name:</td>
            <td>{{$shop->shop_name}}</td>
        </tr>
        <tr>
            <td>Shop Owner Name:</td>
            <td>{{$shop->shop_owner_name}}</td>
        </tr>
        <tr>
            <td>Shop Owner Email:</td>
            <td>{{$shop->shop_owner_email}}</td>
        </tr>
        <tr>
            <td>Shop Owner Phone:</td>
            <td>{{$shop->shop_phone}}</td>
        </tr>
        <tr>
            <td>Shop Owner Another Phone:</td>
            <td>{{$shop->shop_another_phone}}</td>
        </tr>
        <tr>
        <td>Owner Photo:</td>
           
           <td>
           <div style="max-width: 150px; max-height:150px">
           <img src="{{ asset($shop->shop_owner_photo) }}" class="img-fluid img-rounded" alt="">
          </div>
        </td>
        </tr>
        <tr>
            <td>Shop District:</td>
            <td>{{$shop->district->district_name}}</td>
        </tr>
        <tr>
            <td>Shop City:</td>
            <td>{{$shop->shop_city}}</td>
        </tr>
        <tr>
            <td>Shop Area:</td>
            <td>{{$shop->shop_area}}</td>
        </tr>
        <tr>
            <td>Open Time:</td>
            <td>{{$shop->open_time}} AM</td>
        </tr>
        @php
        $close_time=$shop->close_time;
        $time=(int)$close_time-(int)12;

        @endphp
        <tr>
            <td>Close Time:</td>
            <td>{{$time}}.00 PM</td>
        </tr>
        <tr>
            <td>Registration Date:</td>
            <td>{{$shop->registration_date}}</td>
        </tr>
        <tr>
            <td>Status :</td>
            @if($shop->status==1)
            <td>Active</td>
            @else 
            <td>Inactive</td>
            @endif
        </tr>
      
    </table>
        </div>
  
    </div>
</div>
</div>

@endsection