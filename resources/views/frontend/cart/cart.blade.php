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
						@if($content->isEmpty())
						<div class="empty">
						<h3>Your cart is empty! </h2>
						<p class="text-center">Add items it to now</p>
						<button class="btn btn-success cart-shop "><i class="fas fa-cart-plus"></i> <a href="{{route('website.home',$shop_slug)}}" class="text-white">Shop Now</a></button>
						</div>
				
						@else
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($content as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{ asset('storage/files/products/'.$row->options->thumbnail) }}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ substr($row->name,0,10) }}..</div>
										</div>
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Weight</div>
											<div class="cart_item_text">{{ substr($row->options->product_weight,0,10) }}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text">
                               
									<input id="quantity_input" class="cartqty" data-id=
									{{$row->rowId}} type="number" name="qty" pattern="[1-9]*" min="1" value="{{$row->qty}}" required>
								
							
                                            </div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{$setting->currency}} {{$row->price}} x {{$row->qty}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Sub Total</div>
											<div class="cart_item_text">{{$setting->currency}} {{$row->price * $row->qty}}</div>
										</div>
										
                                        <div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div>
											<div class="cart_item_text">

												<button class="btn btn-danger"><a href="#" data-id="{{$row->rowId}}" class="text-white" id="deleteitem">X</a></button>
										</div>
										</div>
									</div>
								</li>
                                <hr>
                                @endforeach
                          
							</ul>
						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{$setting->currency}}{{Cart::total()}}</div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="btn btn-danger"> <a href="#" class="text-white emptycart">Clear Cart</a> </button>
							<button type="button" class="btn btn-warning text-white "><a class="text-white" href="{{route('checkout')}}">Check Out</a></button>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- cart item delete -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
		$('body').on('click','#deleteitem',function(){
			$id=$(this).data('id');
				$.ajax({
		url:'{{url('cartitem/remove/')}}/'+$id,
		type:'get',
		async:false,
		success:function(data){
			toastr.success(data);
		
			location.reload();
      }
    });
		})

	</script>

	<!-- cart item quantity update -->
<script>
		$('body').on('blur','.cartqty',function(){
			$qty=$(this).val();
			$rowId=$(this).data('id');
	
			$.ajax({
		url:'{{url('cartitem/update/')}}/'+$rowId+ '/'+$qty,
		type:'get',
		async:false,
		success:function(data){
			toastr.success(data);
		
			location.reload();
      }
    });
		})

	</script>

	<!-- cart empty -->
	<script>
		$('body').on('click','.emptycart',function(){
	
			$.ajax({
		url:'{{url('cart/empty/')}}',
		type:'get',
		async:false,
		success:function(data){
			toastr.success(data);
			location.reload();
		
	
      }
    });
		})

	</script>




	    
	
@endsection