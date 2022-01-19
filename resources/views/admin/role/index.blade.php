@extends('layouts.admin')

@section('title','Role')
@section('admin_content')

<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>


  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Role</li>
            </ol>
          </div>
        </div>
      </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Role List Here</h3>
               <a href="{{route('role.create')}}"><button class="btn btn-primary" style="float:right;">Add New</button></a> 
              </div>
          
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Position</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                   @foreach($role as $key=>$row) 	
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td>{{ $row->email }}</td>
                      <td>{{ $row->phone }}</td>
                      <td>{{ $row->position }}</td>
                      <td>
                        @if($row->district==1) <span class="badge badge-success">District</span>@endif
                        @if($row->shop==1) <span class="badge badge-success">Shop</span>@endif
                        @if($row->category==1) <span class="badge badge-success">Category</span>@endif
                        @if($row->product==1) <span class="badge badge-success">Product</span>@endif
                        @if($row->shipping_cost==1) <span class="badge badge-success">Shipping_cost</span>@endif
                        @if($row->ticket==1) <span class="badge badge-success">Ticket</span>@endif
                        @if($row->offer==1) <span class="badge badge-success">Offer</span>@endif
                        @if($row->order==1) <span class="badge badge-success">Order</span>@endif
                        @if($row->pickup_point==1) <span class="badge badge-success">Pickup_point</span>@endif
                        @if($row->currency==1) <span class="badge badge-success">Currency</span>@endif
                        @if($row->report_chart==1) <span class="badge badge-success">Report_chart</span>@endif
                        @if($row->report==1) <span class="badge badge-success">Report</span>@endif
                        @if($row->setting==1) <span class="badge badge-success">Setting</span>@endif
                        @if($row->reivew==1) <span class="badge badge-success">Review</span>@endif
                        @if($row->contact_message==1) <span class="badge badge-success">Contact_message</span>@endif
                        @if($row->role==1) <span class="badge badge-success">Role</span>@endif
                        @if($row->subscriber==1) <span class="badge badge-success">Subscriber</span>@endif
                        @if($row->customer==1) <span class="badge badge-success">Customer</span>@endif

                      </td>
                      <td>
                      	<a href="{{route('role.edit',$row->id)}}" class="btn btn-info btn-sm edit" ><i class="fas fa-edit"></i></a>
                      	<a href="{{route('role.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('Backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>





 
  





@endsection