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
			<h2 class="home_title">{{$page->page_title}}</h2>
		</div>
	</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            {!!$page->page_description!!}
        </div>
    </div>
</div>

    @endsection