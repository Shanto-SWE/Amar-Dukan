
<?php
Use\App\Http\Controllers\Front\WishlistController;



$total=0;
if(Session::has('user'))
{
  $total= WishlistController::wishlist();
}




?>
@php
$category=DB::table('categories')->orderBy('category_name','ASC')->get();
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amar Dukan</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{asset('frontend')}}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/custome.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">



</head>

<body>

<div class="super_container disnav">
<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
  <div class="container">
    <a class="navbar-brand text-white" href="{{route('district.show')}}"><img class="navlogo" src="{{ asset($setting->logo) }}" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
	  <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="#"><i class="fas fa-phone"></i> +8801907-925559</a>
        </li>
		<li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="#"><i class="fas fa-envelope"></i>  shanto35-303@diu.edu.bd</a>
        </li>
        @if(!Session()->has('user'))
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="{{route('user.registerwithemail')}}"><i class="far fa-user"></i> Registration</a>
        </li>
		<li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="{{route('user.loginwithemail')}}"> Login</a>
        </li>
@else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		  <i class="far fa-user"></i> {{Session::get('user')['FullName']}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <li><a class="dropdown-item text-dark" href="{{route('user.dashboard')}}"><i class="far fa-user float-left headericon"></i> Profile</a></li>
            <li><a class="dropdown-item text-dark" href="{{route('my.order')}}"><i class="fas fa-shopping-bag float-left headericon"></i> Order list</a></li>
            <li><a class="dropdown-item text-dark" href="{{route('user.passwordchange')}}"><i class="fas fa-unlock float-left headericon"></i> Password Change</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-dark" href="{{route('user.logout')}}"> <i class="fas fa-sign-out-alt float-left headericon"></i>Logout</a></li>
          </ul>
        </li>
 @endif
      </ul>
     
    </div>
  </div>
</nav>
	
		

	

    @yield('content')

    @include('layouts.front_partial.footer')


<script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('frontend')}}/styles/bootstrap4/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{asset('frontend')}}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{asset('frontend')}}/plugins/easing/easing.js"></script>
<script src="{{asset('frontend')}}/js/custom.js"></script>
<script src="{{ asset('frontend') }}/js/product_custom.js"></script>


<script>

window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
	document.getElementById("logotext").innerHTML ='Aamar Dukan';

  } else {
    navbar.classList.remove("sticky");
	document.getElementById("logotext").innerHTML ='';
  }
}
 </script>



<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
	 @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>


</body>
</html>