@extends('layouts.admin')

@section('title','Campaign_Product_Update')
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
            <h1>Update Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update product</li>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{route('campaign.product.update')}}" method="post" enctype="multipart/form-data" id="add_form">
        @csrf
       	<div class="row">
 
          <div class="col-md-8">
        
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Product</h3>
              </div>
       
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ $product->name }}"  required="">
                      <input type="hidden" name="id" value="{{ $product->id }}">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Product quantity <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}"  required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputPassword1">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" value="{{ $product->code }}" name="code" required="">
                    </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-lg-4">
                    <label for="exampleInputEmail1">Shop Name <span class="text-danger">*</span> </label>
                      <select class="form-control" name="campaign_id" id="campaign_id" required>
              
                        @foreach($shop as $row)
                         <option value="{{ $row->id }}"  @if($row->id==$product->campaign_id) selected="" @endif>{{ $row->shop_name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id">
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}"  @if($row->id==$product->brand_id) selected="" @endif>{{ $row->brand_name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point_id">
                        @foreach($pickup_point as $row)
                          <option value="{{ $row->id }}"  @if($row->id==$product->pickup_point_id) selected="" @endif>{{ $row->pickup_point_name  }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                   
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="unit"  value="{{ $product->unit }}" required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Stock</label>
                      <input type="text" name="stock_quantity"value="{{ $product->stock_quantity }}" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Purchase Price  </label>
                      <input type="text" class="form-control" value="{{ $product->purchase_price }}" name="purchase_price">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price"value="{{ $product->selling_price }}" class="form-control" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Discount Price<span class="text-danger">*</span> </label>
                      <input type="text" name="discount_price"value="{{ $product->discount_price }}" class="form-control" required="">
                    </div>
                
                  </div>
                  
                

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Product Details</label>
                      <textarea class="form-control textarea" name="description">{{ $product->description }}</textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Video Embed Code</label>
                      <input class="form-control" name="video"  >{{ $product->video }}</input>
                      <small class="text-danger">Only code after embed word</small>
                    </div>
                  </div>
                </div>
              
            </div>
       
           </div>
    
          <div class="col-md-4">
         
            <div class="card card-primary">
              <div class="card-body">
              <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                    <input type="file" name="thumbnail"  accept="image/*" class="dropify">
                    <input type="hidden" name="old_thumbnail" value="{{ $product->thumbnail }}">
                    <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset('storage/files/products/'.$product->thumbnail) }}" class="img-fluid" alt="">
                                                    </div>
                  </div><br>
                
                    
                     


                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1"  @if($product->status==1) checked @endif checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>
                  
              </div>
         
            </div>
       
           </div>
           <button class="btn btn-info ml-2 w-100" type="submit">Submit</button>
         </div>
        </form>
      </div>
    </section>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('Backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


<script type="text/javascript">
  $('.dropify').dropify(); 
  </script> 
  
  <script type="text/javascript">
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>





 
  





@endsection