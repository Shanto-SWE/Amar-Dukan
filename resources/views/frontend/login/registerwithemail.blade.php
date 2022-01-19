
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
                  <h3>Sign Up</h3>
   
                </div>
                <form action="{{route('user.registration')}}" method="post">
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
                <div class="form-group first">
                    <label for="username">FullName</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname') }}"required>

                  </div>
                  <div class="form-group first">
                    <label for="username">Phone</label>
                    <input type="number" name="phone" class="form-control" id="username" required>

                  </div>
                  <div class="form-group ">
                    <label for="username">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="email" required>

                  </div>
               
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    
                  </div>
              

                  <input type="submit" value="SignUp" class="btn btn-pill text-white btn-block btn-primary mb-3">

                  
                  
                  
                </form>
                <span>Already have account? please <a href="{{route('user.loginwithemail')}}" class="text-primary">Singin</a></span>
              </div>
          </div>
        </div>
      </div>
    </div>

  
    <script src="{{asset('login')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('login')}}/js/popper.min.js"></script>
    <script src="{{asset('login')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('login')}}/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection