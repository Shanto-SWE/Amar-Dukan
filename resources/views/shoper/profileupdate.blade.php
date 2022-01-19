@extends('layouts.shoper')
@section('shoper_content')
<div class="content-wrapper shoperprofile">

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Shoper Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('shoper.home')}}">Home</a></li>
          <li class="breadcrumb-item active"> profile</li>
        </ol>
      </div>
    </div>
  </div>
</div>


<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-8 offset-2">
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
      
            <h3 class="card-title">Update Your Profile</h3>
          </div>

          <form action="{{route('shoper.profile.update')}}" method="Post"  enctype="multipart/form-data">
          @csrf
         
            <div class="card-body">
            <div class="form-group">
            <label for="shop_name">shop Name</label>
            <input type="text" class="form-control"  name="shop_name" value="{{$shoperdetails->shop_name}}" placeholder="shop Name" required> 
            <input type="hidden" name="id" value="{{ $shoperdetails->id }}">
          </div>
          <div class="form-group">
            <label for="shop_owner_name">Owner Name</label>
            <input type="text" class="form-control"  name="shop_owner_name"  value="{{$shoperdetails->shop_owner_name}}"  placeholder="Owner name" required> 
          </div>
    
          <div class="form-group">
            <label for="shop_name">Owner Email</label>
            <input type="text" class="form-control"  name="shop_owner_email"  value="{{$shoperdetails->shop_owner_email}}"  placeholder="Owner Email" required> 
          </div> 
          
          <div class="form-group">
            <label for="shop_district">shop district</label>
            <select class="form-control" name="district_id" required>
                      <option value="" >Select district</option>
                        @foreach($district as $row)
                          <option value="{{ $row->id }}" @if($row->id==$shoperdetails->district_id) selected="" @endif>{{ $row->district_name  }}</option>
                        @endforeach
                      </select>
          </div> 
          
          <div class="form-group">
            <label for="city">Shop city</label>
            <input type="text" class="form-control"  name="shop_city"  value="{{$shoperdetails->shop_city}}"  placeholder="shop city" required>
          </div>   

          <div class="form-group">
            <label for="shop_area">Shop area</label>
            <input type="text" class="form-control"  name="shop_area"  value="{{$shoperdetails->shop_area}}"  placeholder="shop area" required>
          </div>   

          <div class="form-group">
            <label for="shop_phone">Owner Phone</label>
            <input type="text" class="form-control"  name="shop_phone"  value="{{$shoperdetails->shop_phone}}"  placeholder="shop Phone" required>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Another Phone</label>
            <input type="text" class="form-control"  name="shop_another_phone"  value="{{$shoperdetails->shop_another_phone}}"  placeholder="shop another phone">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Open Time</label>
            <input type="time" class="form-control" value="{{$shoperdetails->open_time}}" name="open_time"  placeholder="open time">
     
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Close Time</label>
            <input type="time" class="form-control" value="{{$shoperdetails->close_time}}"  name="close_time"  placeholder="close time">
          </div> 

          <div class="form-group">
            <label for="shop_photo">Owner photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="owner_photo" >
            <input type="hidden" name="old_owner_photo" value="{{$shoperdetails->shop_owner_photo }}">
      
      </div> 
      <div class="col-3 d-flex justify-content-center text-center mt-5">
           <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                    <img src="{{ asset($shoperdetails->shop_owner_photo) }}" class="img-fluid" alt="">
                                                </div>
           </div>
  
     </div>  
   
    
            </div>


            <div class="card-footer">
              <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
@endsection
