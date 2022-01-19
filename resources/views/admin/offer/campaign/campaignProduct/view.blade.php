@extends('layouts.admin')

@section('title','Products_view')
@section('admin_content')

<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Product view of {{$productview->name}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <a href="{{ route('campaign.product.create') }}" class="btn btn-primary" > + Add New</a>
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
            <td>Product Photo:</td>
           
            <td>
                                            <div style="max-width: 150px; max-height:150px">
                                                <img src="{{ asset('storage/files/products/'.$productview->thumbnail) }}" class="img-fluid img-rounded" alt="">
                                            </div>
                      </td>
        </tr>
    
       
        <tr>
        @if($productview->brand_id)
            <td>Brand Name:</td>
           
            <td>{{$productview->brand->brand_name}}</td>
            @endif
        </tr>
        <tr>
            <td>Shop Name:</td>
            <td>{{$productview->shop->shop_name}}</td>
        </tr>
        <tr>
            <td>Product Name:</td>
            <td>{{$productview->name}}</td>
        </tr>
        <tr>
            <td>Product Quantity:</td>
            <td>{{$productview->quantity}}</td>
        </tr>
        <tr>
            <td>Stock Quantity:</td>
            <td>{{$productview->stock_quantity}} {{$productview->unit}}</td>
        </tr>
        <tr>
            <td>Code:</td>
            <td>{{$productview->code}}</td>
        </tr>
        <tr>
            <td>Unit:</td>
            <td>{{$productview->unit}}</td>
        </tr>
        <tr>
            <td>purchase_price:</td>
            <td>{{$productview->purchase_price}}{{$setting->currency}}</td>
        </tr>
        <tr>
            <td>Selling_price:</td>
            <td>{{$productview->selling_price}}{{$setting->currency}}</td>
        </tr>
        <tr>
            <td>Discount_price:</td>
            <td>{{$productview->discount_price}}{{$setting->currency}}</td>
        </tr>
        <tr>
            <td>Description:</td>
            <td>{!!$productview->description!!}</td>
        </tr>
       
       
        <tr>
            <td>Status :</td>
            @if($productview->status==1)
            <td>Active</td>
            @else 
            <td>Inactive</td>
            @endif
        </tr>
      
       
        <tr>
            <td>Total View</td>
            <td>{{$productview->view_product}} times</td>
        </tr>
        <tr>
            <td>Create Date</td>
            <td>{{ date('d F , Y', strtotime($productview->date)) }}</td>
        </tr>
    </table>
        </div>
  
    </div>
</div>
</div>

@endsection