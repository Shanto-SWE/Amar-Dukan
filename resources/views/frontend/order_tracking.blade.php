@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">




    @section('content')
    @if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
@endif

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Track Your Order Now</h2>
		</div>
	</div>

<div class="container mt-5 mb-5">
    <div class="row mb-5">
    <div class="col-lg-1"></div>	
	@if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
			   <div class="card col-lg-8 p-4">
			   	   <form action="{{ route('check.order') }}" method="post">
			   	   	@csrf
			   	   	<div class="form-group">
			   	   		<label>Order ID:</label>
			   	   		<input type="text" name="order_id" class="form-control" placeholder="write your order id" required><br>
			   	   		<button class="btn btn-primary">Track Now</button>
			   	   	</div>
			   	   </form>
			   </div>	
			 
			</div>
    </div>
</div>

    @endsection