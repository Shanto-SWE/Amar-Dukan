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

    <title>shoper-login</title>
  </head>
  <body>
  

  
    <div class="content">
      <div class="container">
        <div class="row align-items-center">
         
          <div class="col-md-6 contents offset-3" >
            <div class="form-block">
            <div class="mb-6">
                  <h3 class="text-center">Forgot Password</h3>
             
                </div>
                <p>Input your email we will sent you a reset password link..</p>
                <form action="{{route('shoper.resetpassword.link')}}" method="post">
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
                    <input type="text" name="email" class="form-control"  required>

                  </div>
                
                 

                  <input type="submit" value="Send Password Reset Link" class="btn btn-pill text-white btn-block btn-primary">

                  
                  
                  
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