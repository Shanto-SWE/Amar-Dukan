@extends('layouts.admin')

@section('title','Website-setting')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Setting / Website Setting</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Website Setting</h3>
              </div>
    
              <form role="form" action="{{route('website.setting.update',$setting->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency</label>
                     <select class="form-control" name="currency">
                         <option value="">select currency</option>
                     	 <option value="TK" {{ ($setting->currency == 'TK') ? 'selected': '' }} >TK</option>
                        <option value="৳" {{ ($setting->currency == '৳') ? 'selected': '' }} >৳</option>
                     
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone One</label>
                    <input type="text" class="form-control" name="phone_one" value="{{$setting->phone_one}}" required="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Phone Two</label>
                    <input type="text" class="form-control" name="phone_two" value="{{$setting->phone_two}}" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Email</label>
                    <input type="email" class="form-control" name="main_email" value="{{$setting->main_email}}" >
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Support Email</label>
                    <input type="email" class="form-control" name="support_email" value="{{$setting->support_email}}" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" name="address" value="{{$setting->address}}" >
                  </div>
                 
                  <strong class="text-info">Social Link</strong>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" value="{{$setting->linkedin}}" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}" >
                  </div>

                  <strong class="text-info">Logo & Favicon</strong>
        
                  <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="exampleInputEmail1">Main Logo</label>
                    <input type="file" class="form-control dropify" name="logo" >
                    <input type="hidden" name="old_logo" value="{{$setting->logo}}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($setting->logo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div> 
                  
            <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="exampleInputEmail1">Favicon</label>
                    <input type="file" class="form-control dropify" name="favicon">
                    <input type="hidden" name="old_favicon" value="{{$setting->favicon}}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($setting->favicon) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div> 
                </div>
               

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary w-100">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
   
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
	$('.dropify').dropify();

</script>
@endsection
