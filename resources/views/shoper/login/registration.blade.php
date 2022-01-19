@extends('layouts.front_partial.districtnav')



    @section('content')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('login')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <section class="content ">
      <div class="container-fluid ">
  
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
          
                <h3 class="card-title">Register Your Shop</h3>
              </div>

              <form action="{{route('shoper.makeregistration')}}" method="Post" enctype="multipart/form-data">
              @csrf
             
                <div class="card-body">
                <div class="form-group">
            <label for="shop_name">shop Name</label>
            <input type="text" class="form-control"  name="shop_name"  placeholder="shop Name" required> 
          </div>
          <div class="form-group">
            <label for="shop_owner_name">Owner Name</label>
            <input type="text" class="form-control"  name="shop_owner_name"  placeholder="Owner name" required> 
          </div>
          <div class="form-group">
            <label for="shop_name">Owner Email</label>
            <input type="text" class="form-control"  name="shop_owner_email"  placeholder="Owner Email" required> 
          </div> 
          
          <div class="form-group">
            <label for="shop_district">shop district</label>
            <select class="form-control" name="district_id" required>
                      <option value="" >Select district</option>
                        @foreach($district as $row)
                          <option value="{{ $row->id }}">{{ $row->district_name  }}</option>
                        @endforeach
                      </select>
          </div> 
          
          <div class="form-group">
            <label for="city">Shop city</label>
            <input type="text" class="form-control"  name="shop_city"  placeholder="shop city" required>
          </div>   

          <div class="form-group">
            <label for="shop_area">Shop area</label>
            <input type="text" class="form-control"  name="shop_area"  placeholder="shop area" required>
          </div>   

          <div class="form-group">
            <label for="shop_phone">Owner Phone</label>
            <input type="text" class="form-control"  name="shop_phone"  placeholder="shop Phone" required>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Another Phone</label>
            <input type="text" class="form-control"  name="shop_another_phone"  placeholder="shop another phone">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Open Time</label>
            <input type="time" class="form-control"  name="open_time"  placeholder="open time">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Close Time</label>
            <input type="time" class="form-control"  name="close_time"  placeholder="close time">
          </div> 
          <div class="form-group">
            <label for="shop_photo">Owner photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="owner_photo" required="">

          </div>  
          <div class="form-group">
            <label for="shop_photo">Shop photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="shop_photo" required="">
            <small id="emailHelp" class="form-text text-muted">This is your shop photo </small>
          </div> 
          
          <div class="form-group ">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    
                  </div>
                  <p>Aready have a account?<span> <a href="{{route('shoper.login')}}" class="loginlink">SignIn</a></span></p>

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
	$('.dropify').dropify();

</script>
    @endsection