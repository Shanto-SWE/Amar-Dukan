@extends('layouts.admin')

@section('title','User_view')
@section('admin_content')

<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">User details of {{$user->FullName}} </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <a href="{{ route('user.index') }}" class="btn btn-primary" >User</a>
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
    <td>User Photo:</td>
           
           <td>
            <div style="max-width: 150px; max-height:150px">
            <img src="{{ asset($user->photo) }}" class="img-fluid img-rounded" alt="">
            </div>
            </td>
        </tr>
        <tr>
            <td>User Name:</td>
            <td>{{$user->FullName}}</td>
        </tr>
        <tr>
            <td>User Email:</td>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>User Phone:</td>
            <td>{{$user->phone}}</td>
        </tr>
        <tr>
            <td>User Occupation:</td>
            <td>{{$user->occupation}}</td>
        </tr>
        <tr>
            <td>User Gender:</td>
            <td>{{$user->gender}}</td>
        </tr>
    
        <tr>
            <td>Delivery Zone:</td>
            <td>{{$user->delivery_zone}}</td>
        </tr>
        <tr>
            <td>Delivery  Area:</td>
            <td>{{$user->delivery_area}}</td>
        </tr>
      
        <tr>
            <td>Delivery Address:</td>
            <td>{{$user->delivery_address}}</td>
        </tr>
     
  
      
    </table>
        </div>
  
    </div>
</div>
</div>

@endsection