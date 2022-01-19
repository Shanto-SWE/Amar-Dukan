
<?php
Use\App\Http\Controllers\Front\WishlistController;



$total=0;
if(Session::has('user'))
{
  $total= WishlistController::wishlist();
}




?>
@php
$category=DB::table('categories')->orderBy('category_name','ASC')->inRandomOrder()->limit(8)->get();
$shop=Session::get('shop')['shop_name'];
$shop_id=Session::get('shop')['id'];



@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@if(Session()->has('shop'))
<title>Amar Dukan({{$shop}})</title>

@else
<title>Amar Dukan</title>

@endif

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">

@if(Session()->has('shop'))
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/bootstrap4/bootstrap.min.css">
@else
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endif
<link href="{{asset('frontend')}}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/custome.css"> 
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">



<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61c88153c4efce0019fd62c5&product=inline-share-buttons" async="async"></script>


</head>

<body>

<div class="super_container">
	
	<header class="header">

		<!-- Top Bar -->
		@if(Session()->has('shop'))
		<div class="top_bar sticky-top">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
					<div class="top_bar_contact_item text-white"><div class="top_bar_icon text-white"><img src="{{asset('frontend')}}/images/phone_white.png" alt=""></div><span class="text-white">+8801907-925559</span></div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('frontend')}}/images/mail_white.png" alt=""></div>
						<a class="text-white" href="shanto35-303@diu.edu.bd">shanto35-303@diu.edu.bd</a></div>
						<div class="top_bar_content ml-auto">
						<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
									@if(Session()->has('user'))
									<i class="far fa-user float-left headericon"></i><a href="#" class="text-white">{{Session::get('user')['FullName']}}<i class="fas fa-chevron-down"></i></a>
										<ul class="headerui">
								
										<li><i class="fas fa-user-circle float-left headericon"></i><a href="{{route('user.dashboard')}}">Profile</a></li>
              
                                            <li><i class="fas fa-shopping-bag float-left headericon"></i><a href="#">Order list</a></li>
											<li><i class="fas fa-unlock float-left headericon"></i><a href="{{route('user.passwordchange')}}">Password Change</a></li>
                                            <li><i class="fas fa-sign-out-alt float-left headericon"></i><a href="{{route('user.logout')}}">Logout</a></li>
											
										</ul>
									</li>
									@endif
									
								</ul>
								
							</div>
							@if(!Session()->has('user'))
							<div class="top_bar_user">
								<div class="user_icon"><img src="{{asset('frontend')}}/images/user.svg" alt=""></div>
								<div><a href="{{route('user.registerwithemail')}} "class="text-white">Register</a></div>
								<div><a href="{{route('user.loginwithemail')}}" class="text-white">Sign in</a></div>
			
							</div>
							@else
							<div class="top_bar_user">
						
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>		
		</div>
@else
		<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
  <div class="container">
    <a class="navbar-brand text-white" href="{{route('district.show')}}"><img class="shopnavlogo" src="{{ asset($setting->logo) }}" alt=""></a>
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
@endif
		<!-- Header Main -->
		@if(Session()->has('shop'))
		
		

		<div class="header_main" id="navbar">
			<div class="container">
				<div class="row">

				<div class="col-lg-4 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo logotext"><a href="{{ route('district.show') }}"><span id="logotext" class="text-white"><img class="shopnavlogo" src="{{ asset($setting->logo) }}" alt=""></span></a></div>
                        </div>
                    </div>

					<div class="col-lg-5 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{route('product.search')}}" class="header_search_form clearfix">
										<input  type="search" required="required" class="header_search_input text-white" name="search_product" placeholder="Search for products..." autocomplete="off">
										<div class="custom_dropdown d-none">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc text-white d-none">All Categories</span>
										
												<ul class="custom_list clc">
												
										
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('frontend')}}/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

				
				
					<div class="col-lg-3 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
							<i class="fas fa-heart wish"></i>
								<div class="wishlist_content">
									<div class="wishlist_text "><a href="{{route('wishlist.show')}}" class="text-white">Wishlist</a></div>
									<div class="wishlist_count  text-white">{{$total}}</div>
								</div>
							</div>

					
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
									<i class="fas fa-shopping-cart"></i>
										<div class="cart_count"><span class="cart_qty"></span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{route('mycart.show')}}" class="text-white">Cart</a></div>
										<div class="cart_price text-white">{{$setting->currency}} <span class="cart_total"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		
        @yield('navbar')
	</header>
	

    @yield('content')

    @include('layouts.front_partial.footer')

@if(!Session()->has('shop'))
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endif
<script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('frontend')}}/styles/bootstrap4/popper.js"></script>
<script src="{{asset('frontend')}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{asset('frontend')}}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{asset('frontend')}}/plugins/easing/easing.js"></script>
<script src="{{asset('frontend')}}/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js" integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@stack('scripts')

<script>
function cart(){

	$.ajax({
      url:'{{route('all.cart')}}',
      type:'get',
     dataType:'json',
      success:function(data){
		$('.cart_qty').empty();
	   $('.cart_total').empty();
       $('.cart_qty').append(data.cart_qty);
	   $('.cart_total').append(data.cart_total);

    
      }
    });
}
$(document).ready(function(event){
cart();
});
</script>
<script>

window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");


  } else {
    navbar.classList.remove("sticky");
	
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
	$('.dropify').dropify();


 
</script>


</body>
</html>