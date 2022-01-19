@extends('layouts.shoper')
@section('shoper_content')

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
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product</li>
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
       <form action="{{route('shoper.product.store')}}" method="post" enctype="multipart/form-data" id="add_form">
        @csrf
       	<div class="row">
 
          <div class="col-md-8">
        
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
       
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}"  required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Product quantity <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}"  required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputPassword1">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" value="{{ old('code') }}" name="code" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                    <label for="sbucategory_name">Category Name</label>
                    <select class="form-control" name="category_id" id="shoper_category_id">
              		 	<option value="">All</option>
              		 	  @foreach($category as $row)
              		 	    <option value="{{$row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach  
              		 </select>
                     
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="category_name">Sub_Category Name</label>
  
                       <select class="form-control" name="subcategory_id" id="subcategory_id">
     
                       </select>
                    </div>
                
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id">
                        <option value="">Select brand</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point_id">
                      <option value="" >Select Pickup-point</option>
                        @foreach($pickup_point as $row)
                          <option value="{{ $row->id }}">{{ $row->pickup_point_name  }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="unit" value="{{ old('unit') }}" required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Tags</label><br>
                      <input type="text" name="tags" class="form-control" value="{{ old('tags') }}" name="tags" data-role="tagsinput">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Purchase Price  </label>
                      <input type="text" class="form-control" value="{{ old('purchase_price') }}" name="purchase_price">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price" value="{{ old('selling_price') }}" class="form-control" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Discount Price </label>
                      <input type="text" name="discount_price" value="{{ old('discount_price') }}" class="form-control">
                    </div>
                  </div>
                  <div class="row">
      
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Stock</label>
                      <input type="text" name="stock_quantity" value="{{ old('stock_quantity') }}" class="form-control">
                    </div>
                  </div>

                

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Product Details</label>
                      <textarea class="form-control textarea" name="description">{{ old('description') }}</textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Video Embed Code</label>
                      <input class="form-control" name="video" value="{{ old('video') }}" placeholder="Only code after embed word">
                      <small class="text-danger">Only code after embed word</small>
                    </div>
                  </div>
                </div>
              
            </div>
       
           </div>
    
          <div class="col-md-4">
         
            <div class="card card-primary">
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                    <input type="file" name="thumbnail" required="" accept="image/*" class="dropify">
                  </div><br>
                
                     <div class="card p-4">
                        <h6>Featured Product</h6>
                       <input type="checkbox" name="featured" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Today Deal</h6>
                       <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Slider Product</h6>
                       <input type="checkbox" name="product_slider" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>
                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
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
<script type="text/javascript">

  //ajax request send for collect subcategory
  $("#shoper_category_id").change(function(){
      var id = $(this).val();
      $.ajax({
           url: "{{ url("/get-sub-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="subcategory_id"]').empty();
                $('select[name="subcategory_id"]').append('<option value="">'+ 'All' +'</option>');
                   $.each(data, function(key,data){
                      $('select[name="subcategory_id"]').append('<option value="'+ data.id +'">'+ data.Subcategory_name +'</option>');
                });
           }
        });
     });
</script>




 
  





@endsection