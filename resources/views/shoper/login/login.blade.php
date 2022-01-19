<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('login')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('login')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('Backend/plugins/toastr/toastr.min.css')}}">

    <title>Shopkeeper-login</title>
  </head>
  <body>
  

  
    <div class="content">
      <div class="container">
        <div class="row align-items-center">
         
          <div class="col-md-6 contents offset-3" >
            <div class="form-block">
            <div class="mb-6">
                  <h3 class="text-center">Sign In to Shopkeeper panal</h3>
             
                </div>
                <form action="{{route('shoper.makelogin')}}" method="post">
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
                  if(isset($_COOKIE['shoper_email']) && ($_COOKIE['shoper_password'])){
                    $login_email = Cookie::get('shoper_email');
                    $login_password = Cookie::get('shoper_password');
                    $is_remember="checked='checked";
                  }else{
                    $login_email='';
                    $login_password='';
                    $is_remember="";
                  }

                    @endphp
                  <div class="form-group first">
                    <label for="username">Email</label>
                    <input type="text"  name="email" value="{{$login_email}}" class="form-control"  required>

                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{$login_password}}"   class="form-control" required>
                    
                  </div>
                  
                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                      <input type="checkbox" name="shoper_rememberme" {{$is_remember}}/>
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="{{route('shoper.password.forget')}}" class="forgot-pass">Forgot Password</a></span> 
                  </div>
                  <p>Don't have a account?<span> <a href="{{route('shoper.registration')}}" class="text-success">SignUp</a></span></p>

                  <input type="submit" value="SignIn" class="btn btn-pill text-white btn-block btn-primary">

                  
                  
                  
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
    <!-- toastr -->
<script type="text/javascript" src="{{asset('frontend')}}/plugin/toastr/toastr.min.js"></script>
  </body>
</html>