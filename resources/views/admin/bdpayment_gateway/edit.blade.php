@extends('layouts.admin')

@section('title','Paymeny Gateway')
@section('admin_content')

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payment Gateway</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Setting/Payment gateway </li>
            </ol>
          </div>
        </div>
      </div>
    </div>



    <section class="content">
      <div class="container-fluid">
 
        <div class="row">

            <!-- AmayPay -->   

          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Aamarpay Payment gateway</h3>
              </div>
       
              <form role="form" action="{{route('update.aamarpay')}}" method="Post">
                @csrf
                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">StoreID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $aamarpay->store_id }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Signature KEY</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $aamarpay->signature_key }}" required> 
                  </div>
                  <div class="form-group">
                    <input type="checkbox"  name="status" value="1" @if($aamarpay->status==1) checked @endif > 
                    <label for="exampleInputEmail1">Live Server</label>
                    <small>(If checbox are not checked it working for sandbox only)</small>
                  </div>
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>

        
     <!-- SLL Commerz -->

          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SSL Commerz Payment gateway</h3>
              </div>
         
              <form role="form" action="#" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">StoreID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $ssl->store_id }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Signature KEY</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $ssl->signature_key }}" required> 
                  </div>
                  <div class="form-group">
                    <input type="checkbox"  name="status" value="1" @if($ssl->status==1) checked @endif > 
                    <label for="exampleInputEmail1">Live</label>
                    <small>(If checbox are not checked it working for sandbox only)</small>
                  </div>
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
    </section>
 
  </div>
@endsection