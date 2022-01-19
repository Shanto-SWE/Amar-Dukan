@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">




    @section('content')
	
    @include('layouts.front_partial.collaps_nav')

	@php
	$shop_slug=Session::get('shop')['shop_slug'];

	@endphp
<!-- Cart -->

<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
					@if($wishlist->isEmpty())
						<div class="empty">
						<h3>Your Wishlist is empty!</h2>
						<p class="text-center">Add items it to now</p>
						<button class="btn btn-success cart-shop "><i class="fas fa-cart-plus"></i> <a href="{{route('website.home',$shop_slug)}}" class="text-white">Shop Now</a></button>
						</div>
				
						@else
						<div class="cart_title"> Your Wishlist Items</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($wishlist as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{ asset('storage/files/products/'.$row->product->thumbnail) }}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
									
											<div class="cart_item_text">{{$row->product->name}}</div>
										</div>
										<div class="cart_item_name cart_info_col">
										
											<div class="cart_item_text">{{$row->date}}</div>
										</div>
									
									
									
                                        <div class="cart_item_total cart_info_col">
									
											<div class="cart_item_text">
											
													<button class="btn btn-warning"> <a href="{{ route('product.details',$row->product->slug) }}" class="text-white">Add To Cart</a> </button>
												
										
										</div>
										</div>
										<div class="cart_item_total cart_info_col">
									
											<div class="cart_item_text">
											
													<button class="btn btn-danger"> <a href="{{route('wishlistitem.delete',$row->product->id)}}" class="text-white">X</a> </button>
												
										
										</div>
										</div>
									</div>
								</li>
                                <hr>
                                @endforeach
                          
							</ul>
						</div>
					

						<div class="cart_buttons">
						<button type="button" class="btn btn-danger"> <a href="{{route('wishlist.clear')}}" class="text-white emptycart">Clear Wishlist</a> </button>
							<button type="button" class="btn btn-primary"> <a href="#" class="text-white emptycart">Back Home</a> </button>

							
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>




	    
	
@endsection