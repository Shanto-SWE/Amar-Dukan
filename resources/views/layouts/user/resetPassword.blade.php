@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">


@section('content')
@if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
@endif

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('login')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/style.css">


  

  
    <div class="content">
      <div class="container">
        <div class="row align-items-center">
         
    
          <div class="col-md-6 contents offset-3">
            <div class="form-block">
            <div class="mb-4">
                  <h3>Reset your password </h3>
                  
   
                </div>
              
                <form action="{{route('password.update')}}" method="post">
                @csrf
                @if (Session::has('success'))
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
  </div>
@endif
        
                @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group first">
                    <label for="username">Email</label>
                    <input type="text" name="email" class="form-control" required>
                    <input type="hidden" name="token" value="{{ $token }}">

                  </div>
                  <div class="form-group first">
                    <label for="username">Password</label>
                    <input type="password" name="password" class="form-control" required>

                  </div>
                  <div class="form-group first">
                    <label for="username">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>

                  </div>
               
                  
             

                  <input type="submit" value="Reset Password" class="btn btn-pill text-white btn-block btn-primary mb-3">

                  
                  
                  
                </form>
              
              </div>
          </div>
        </div>
      </div>
    </div>

  
    <script src="{{asset('login')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('login')}}/js/popper.min.js"></script>
    <script src="{{asset('login')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('login')}}/js/main.js"></script>
@endsection