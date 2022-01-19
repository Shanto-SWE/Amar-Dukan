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
       
       <div class="card-header">
   
         <h3 class="card-title">Change Your Password</h3>
       </div>

       <form action="{{route('user.password.update')}}" method="Post">
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
             <label for="exampleInputEmail1">Old Password</label>
             <input type="password" class="form-control" name="old_password" id="exampleInputEmail1" placeholder="Old Password" required>
           </div>

           <div class="form-group">
             <label for="exampleInputPassword2">New Password</label>
             <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder="New Password" required>
           
           </div>
           

           <div class="form-group">
             <label for="exampleInputPassword3">Confirm Password</label>
             <input type="password" class="form-control" name="ConfirmPassword" id="exampleInputPassword3" placeholder="ConfirmPassword" required>
           </div>
         </div>


         <div class="card-footer">
           <button type="submit" class="btn btn-primary w-100">Update Password</button>
         </div>
       </form>
     </div>
       </div>
    </div>
</div><hr>
@endsection
