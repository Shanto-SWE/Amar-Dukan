@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
@section('content')
@if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
<div class="container  mt-5">
  @else
  <div class="container dashboard mt-5">
@endif

    <div class="row justify-content-center">
        <div class="col-md-4">
       @include('layouts.user.sidebar')
        </div>
       <div class="col-md-6">
       <div class="card card-primary">
       
       <div class="card-header  bg-primary">
   
         <h3 class="card-title text-white">Your Prifile</h3>
       </div>

       <form action="{{route('user.profile.update')}}" method="Post" enctype="multipart/form-data">
       @csrf
       @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
         <div class="card-body">
           <div class="form-group">
             <label for="exampleInputEmail1">FullName</label>
             <input type="name" class="form-control text-dark" name="name" value="{{$userdetails->FullName}}" id="exampleInputEmail1" placeholder="Your full name" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Email</label>
             <input type="text" class="form-control text-dark" name="email" value="{{$userdetails->email}}" id="exampleInputEmail1" placeholder="Your email" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Phone</label>
             <input type="text" class="form-control text-dark" name="phone" value="{{$userdetails->phone}}" id="exampleInputEmail1" placeholder="Your phone" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Delivery Zone</label>
             <input type="text" class="form-control text-dark" name="delivery_zone" value="{{$userdetails->delivery_zone}}" id="exampleInputEmail1" placeholder="Delivery zone" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Delivery Area</label>
             <input type="text" class="form-control text-dark" name="delivery_area" value="{{$userdetails->delivery_area}}" id="exampleInputEmail1" placeholder="Delivery area" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Delivery Address</label>
             <input type="text" class="form-control text-dark" name="delivery_address" value="{{$userdetails->delivery_address}}" id="exampleInputEmail1" placeholder="Delivery address" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Occupation</label>
             <input type="text" class="form-control text-dark" name="occupation" value="{{$userdetails->occupation}}" id="exampleInputEmail1" placeholder="Occupation" >
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Gender</label>
             <select class="form-control text-dark" name="gender" style="min-width: 200px;" >
                     
                     <option value="male"@if($userdetails->gender=='male') selected="" @endif>Male</option>
                     <option value="female" @if($userdetails->gender=='female') selected="" @endif>Female</option>
                     <option value="other" @if($userdetails->gender=='other') selected="" @endif>Other</option></option>
             
                 </select>
           </div>
           <div class="form-group">
            <label for="shop_photo">photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="photo" >
            <input type="hidden" name="old_photo" value="{{$userdetails->photo }}">
      
          </div> 
          <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($userdetails->photo) }}" class="img-fluid" alt="">
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
</div><hr>
@endsection
