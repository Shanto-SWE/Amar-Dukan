
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
          <div class="col-md-5">
            <span class="d-block text-center my-4 text-muted"> or sign in with</span>
            <div class="social-login text-center">
            <a href="{{route('user.loginwithphone')}}" class="facebook btn btn-block signwithphone">
                <span>sign in with phone number</span> 
              </a>
              
            </div>

          </div>
          <div class="col-md-2 text-center">
            &mdash; or &mdash;
          </div>
          <div class="col-md-5 contents">
            <div class="form-block">
            <div class="mb-4">
                  <h3>Sign In </h3>
   
                </div>
                <form action="{{route('user.makeloginwithemail')}}" method="post">
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
               <!-- remember me  -->
                    @php
                  if(isset($_COOKIE['email']) && ($_COOKIE['password'])){
                    $login_email=$_COOKIE['email'];
                    $login_password=$_COOKIE['password'];
                    $is_remember="checked='checked";
                  }else{
                    $login_email='';
                    $login_password='';
                    $is_remember="";
                  }

                    @endphp

                  <div class="form-group first">
                    <label for="username">Email</label>
                    <input type="text" name="email" value="{{$login_email}}" class="form-control" id="username" required>

                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" value="{{$login_password}}" name="password" class="form-control" id="password" required>
                    
                  </div>
                  
                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                      <input type="checkbox" name="remember_me" {{$is_remember}}/>
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="{{route('password.forget')}}" class="forgot-pass">Forgot Password</a></span> 
                  </div>

                  <input type="submit" value="SignIn" class="btn btn-pill text-white btn-block btn-primary mb-3">

                  
                  
                  
                </form>
                <span>Don't have an account? please <a href="{{route('user.registerwithemail')}}" class="text-primary">Singup</a></span>
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