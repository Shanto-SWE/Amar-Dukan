@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">





    @section('content')
	@include('layouts.front_partial.collaps_nav')

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('login')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <section class="content">
      <div class="container-fluid">
  
        <div class="row">
          <div class="col-6 offset-3">
          @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card card-primary">
       
              <div class="card-header">
          
                <h3 class="card-title">Product Request</h3>
              </div>

              <form action="{{route('product.request.store')}}" method="Post" enctype="multipart/form-data">
              @csrf
             
                <div class="card-body">
                <div class="form-group">
            <label for="shop_name">Product Name</label>
            <input type="text" class="form-control"  name="product_name"  placeholder="product name" required> 
          </div>
          <div class="form-group">
            <label for="shop_owner_name">Product Origin</label>
            <input type="text" class="form-control"  name="product_origin"  placeholder="product origin" required> 
          </div>
          <div class="form-group">
            <label for="shop_name">Product Weight</label>
            <input type="text" class="form-control"  name="product_weight"  placeholder="product weight" required> 
          </div> 
          
   
          
          <div class="form-group">
            <label for="city">Product Quantity</label>
            <input type="text" class="form-control"  name="product_quantity"  placeholder="product quantity" required>
          </div>   

          <div class="form-group">
          <label for="exampleInputPassword1">Product Description</label>
                      <textarea class="form-control textarea" name="product_description">{{ old('description') }}</textarea>
          </div>   
          <div class="form-group">
            <label for="shop_photo">Product Photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="product_photo" required="">

          </div> 
          
          <div class="form-group">
            <label for="shop_phone">Delivery Date</label>
            <input type="date" class="form-control"  name="delivery_date"  placeholder="shop Phone" required>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Your Name</label>
            <input type="text" class="form-control"  name="name"  placeholder="your name">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Email</label>
            <input type="email" class="form-control"  name="email"  placeholder="your email">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Phone</label>
            <input type="number" class="form-control"  name="phone"  placeholder="your phone">
          </div> 
     
        
          <div class="form-group">
            <label for="shop_another_phone">District</label>
            <select class="form-control " name="city" >
              		 	<option value="">select district</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->district_name }}">{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Delivery Area</label>
            <input type="text" class="form-control"  name="delivery_area"  placeholder="delivery area">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Delivery Address</label>
            <input type="text" class="form-control"  name="delivery_address"  placeholder="delivery address">
          </div> 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


    <script src="{{asset('login')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('login')}}/js/popper.min.js"></script>
    <script src="{{asset('login')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('login')}}/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
	$('.dropify').dropify();

</script>
    @endsection