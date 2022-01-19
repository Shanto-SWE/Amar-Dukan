@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">

 



    @section('content')
	@include('layouts.front_partial.collaps_nav')
	<!-- rating calculate -->
	@php

						$review_5=App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
						$review_4=App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
						$review_3=App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
						$review_2=App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
						$review_1=App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();
						$sum_rating=App\Models\Review::where('product_id',$product->id)->sum('rating');
                       $count_rating=App\Models\Review::where('product_id',$product->id)->count('rating');
						@endphp
    <div class="single_product">
		<div class="container">
			<div class="row ">
		
				<!-- Selected Image -->
				<div class="col-lg-4 order-lg-2 order-1 mt-5 ">
					<div class="image_selected"><img src="{{ asset('storage/files/products/'.$product->thumbnail) }}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3  ">
					<div class="product_description">
					<div class="product_categoryname">{{ $product->category->category_name }} >{{ $product->subcategory->Subcategory_name }} </div>
					
					<div class="product_name">{{$product->name}}</div>
					{{-- review star --}}
					 <div>
						 @if($sum_rating)
					@if($sum_rating !=NULL)	
					 	@if(intval($sum_rating/$count_rating) == 5)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@else
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@endif
					@endif 
					
					@else
					<p>(No Coustomers Reivews)</p>

					@endif
					 </div>
						<div class="product_category">{{$product->quantity}}</div>

					
						<div class="product_text pt-2"><p>{!!$product->description!!}</p></div>
						<div class="order_info d-flex flex-row">
						<form action="{{route('add.to.cartqv')}}" method="post" id="add_to_cart">
                  @csrf
                  <input type="hidden" name="id" value="{{$product->id}}">
                  <input type="hidden" name="name" value="{{$product->name}}">
                  @if($product->discount_price==NULL)
                  <input type="hidden" name="price" value="{{$product->selling_price}}">
                  @else
                  <input type="hidden" name="price" value="{{$product->discount_price}}">
                  @endif

						@if($product->discount_price==NULL)
                         <div class="banner_price" style="margin-top: 30px;">{{ $setting->currency }}{{ $product->selling_price }}.00</div>
                        @else
                          <div class="banner_price" style="margin-top: 30px;">{{ $setting->currency }}{{ $product->discount_price }}.00 <span>{{ $setting->currency }}{{ $product->selling_price }}.00</span></div>
                        @endif
				
						<div class="clearfix mt-3 mb-3" >
								
								<!-- Product Quantity -->
								<div class="product_quantity  ml-2">
									<span>Quantity: </span>
									<input id="quantity_input" type="text" name="qty" pattern="[1-9]*" min="1" value="1">
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
									</div>
								</div>
							</div>
					
							
							<div class="button_container mt-5">
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									  @if($product->stock_quantity<1)
									  <button class="btn btn-danger" type="disabled">Out of stock</button>
									  @else
								    <a href=""><button class="btn btn-outline-warning" type="submit">ADD TO CART</button></a>
									<a href="{{ route('add.wishlist',$product->id) }}" class="btn btn-outline-warning" type="button">Add to wishlist</a>
									@endif
								
								  </div>
								  
								</div>
						
								<div class="sharethis-inline-share-buttons"></div>
								
						
							</div>
								
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3 order-3 mt-4" style="border-left: 1px solid grey; padding-left: 10px;">

			@isset($product->shop->district_id)
				@php 
            $district=DB::table('districts')->where('id',$product->shop->district_id)->first();
		
              @endphp
			  @endisset

		


				@isset($product->shop_id) 
				<strong class="text-muted">Shop name of this product</strong><br>
				<i class="fa fa-map"> Name:{{ $product->shop->shop_name }} <br>
				<i class="fas fa-map-marker-alt"> </i> Address: {{ $product->shop->shop_area }},{{ $product->shop->shop_city }},{{ $district->district_name }} </i><br>
				<i class="fas fa-phone-volume"></i> Phone: {{ $product->shop->shop_phone }}</i><hr><br>
				@endisset 
				<strong class="text-muted"> Home Delivery :</strong><br>
				 -> 1 days after the order placed.<br> 
				 -> Cash on Delivery Available.
				 <hr><br>
				 <strong class="text-muted"> Return & Warranty :</strong><br>
				 -> 100% Authentic.<br> 
				 ->	14 days easy return <br>
				 <span class="changemind">Change of mind is not applicable</span> <br>
				 ->Warranty not available
				 <hr><br>
			 	@isset($product->video) 
				 <strong>Product Video : </strong>
				 <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				@endisset 
			</div>
			</div>
		</div>
	</div>
<!-- reating  -->
<div class="row">
			<div class="col-lg-8 offset-2">
			 <div class="card">
			  <div class="card-header">
				<h4>Ratings & Reviews of {{ $product->name }}  </h4>
			  </div>
			  
               @if($sum_rating!=NULL)
			   @php
			    $rating=$sum_rating/$count_rating;
			     $rating_value=round($rating, 1);
			   @endphp


			   @endif

				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
						@if($sum_rating !=NULL)

						<h1 class="rating_number">{{$rating_value}}\<span class="rating">5</span></h1>
						
					
							@if(intval($sum_rating/$count_rating) == 5)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@else
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
						@endif
							@endif	
							<p class="pt-2">{{$count_rating}} Ratings</p>
						</div>
					
					
					
						<div class="col-md-3">
							{{-- all review show --}}
							Total Review Of This Product:<br>
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span>Total {{$review_5}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span>Total {{$review_4}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span>Total {{$review_3}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span>Total {{$review_2}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span>Total {{$review_1}} </span>
										</div>
							
									
						</div>
						<div class="col-lg-6">
							<form action="{{ route('store.review') }}" method="post" id="add_form">
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
							  <div class="form-group">
							    <label for="details">Write Your Review</label>
							    <textarea type="text" class="form-control" name="review" required=""></textarea>
							  </div>
								<input type="hidden" name="product_id" value="{{ $product->id }}">
							  <div class="form-group ">
							    <label for="review">Write Your Rating</label>
							     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;" required>
							     	<option value="">Select Your Rating</option>
							     	<option value="1">1 star</option>
							     	<option value="2">2 star</option>
							     	<option value="3">3 star</option>
							     	<option value="5">4 star</option>
							     	<option value="5">5 star</option>
							     </select> 
							     
							  </div>
							  @if(Session()->has('user'))
					
							  <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star checked "></span> submit review</button>
							@else
							   <p>Please at first login to your account for submit a review.</p>
							@endif
							</form>
						</div>
					</div>
						<br>
						{{-- all review of this product --}}
						<strong>All review of {{ $product->name }}</strong> <hr>
						<div class="row">
						@foreach($review as $row)
							<div class="card col-lg-5 m-2">
						 	 <div class="card-header productreview">
						 	 		<img src="{{asset($row->user->photo)}}" alt="user_img"> {{ $row->user->FullName }}  ( {{ date('d F , Y'), strtotime($row->review_date) }} )
						 	 </div>
						 	 <div class="card-body">
						 	 		{{ $row->review }}
						 	 		  @if($row->rating==5)
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==4)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==3)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==2)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==1)
										<div>
											<span class="fa fa-star checked"></span>
										</div>
										@endif
						 	 </div>
						 </div>
					  @endforeach
					</div>	
				</div>


			 </div>
		
	


			 <!-- count question -->

			 @php
			 $count_question=App\Models\Question::where('product_id',$product->id)->count('question');
			 $queston=App\Models\Question::where('product_id',$product->id)->get();

			 $answer=App\Models\Answer::where('product_id',$product->id)->get();
			 $single_answer=App\Models\Answer::where('product_id',$product->id)->first();
			 @endphp

		<!-- ask question -->
		<div class="card mt-4 mb-5 pb-4">
		<div class="card-header">
				<h4>Questions about this product ({{$count_question}}) </h4>
			  </div>
	         <div class="row">
			 @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
				 <div class="col-md-6 mx-3 mt-3 mb-5">
					 		  <form action="{{route('productAsk.question')}}" method="post">
							   @csrf
							   @if(Session()->has('user'))
			                   <div class="form-group">
							    <label for="details">Ask Question</label>
							    <textarea type="text" class="form-control" name="question" required=""></textarea>
								<input type="hidden" name="product_id" value="{{ $product->id }}">
							  </div>
							
					
					<button class="questionsubmit" type="submit" class="btn btn-sm btn-info">Submit </button>
				  @else
					 <p > <a href="{{route('user.loginwithemail')}}" class="askquestion">Login</a>  or <a href="{{route('user.registerwithemail')}}"class="askquestion">Resgister</a> to ask question.</p>
				  @endif
			              </form>
				 </div>
			 </div>
			 <div class="row">

			 @foreach($queston as $row)
				 <div class="col-md-12 askques mx-3">
					<div class="questonlogo">
                      <p>Q</p>
					
					</div>
			
					<div class="question">
						<h4>{{$row->question}}</h4>
						<p>{{$row->user->FullName}} - {{$row->question_date}}</p>
					</div>
				 </div>
				 @foreach($answer as $answer_show)
				 @if($row->id==$answer_show->question_id)
				 <div class="col-md-12 answer mx-3  mt-4">
					<div class="answerlogo">
                      <p>A</p>
					</div>
					<div class="answertext">
						<h4>{{$answer_show->answer}}</h4>
						<p>{{$answer_show->shop->shop_name}} - {{$answer_show->answer_date}}</p>
					</div>
				 </div>
				 @endif
				 @endforeach
				 <hr>
				 <hr>
				 @endforeach
			
				
			 </div>
			  
		</div>

		</div>
		</div>
	<!-- Related product -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">RELATED PRODUCT</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
				

						<div class="owl-carousel owl-theme viewed_slider" >
					
						@foreach($related_product as $row)		
							<div class="owl-item relateditem" >
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img class="relatedimg" src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="{{ $row->name }}"></div>
									<div class="viewed_content text-center">
									@if($row->discount_price==NULL)
		             <div class="viewed_price">{{ $setting->currency }}{{ $row->selling_price }}.00</div>
		            @else
		             <div class="viewed_price">{{ $setting->currency }}{{ $row->discount_price }}.00 <span>{{ $setting->currency }}{{ $row->selling_price }}.00</span></div>
		            @endif

					<div class="viewed_name"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name, 0, 50) }}</a></div>
									</div>

									
											<!-- discount price  -->
											
											@php
											
											$discount_price=$row->discount_price;
											$selling_price=$row->selling_price;

											$off=(int)$selling_price-(int)$discount_price;

											@endphp
											@if($row->discount_price)
									<ul class="item_marks">
										<li class="item_mark item_discount"><p>{{$off}}tk off</p></li>
									
									</ul>
									@endif
									
								</div>
							</div>

							@endforeach	
						
						
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>




	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script type="text/javascript">

	  //store review ajax call
	  $('#add_form').submit(function(e){
    e.preventDefault();
 
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
      
        $('#add_form')[0].reset();
		location.reload();

		toastr.success(data);

      }
    });
  });
  </script>
        <script>
     //store item to cart
  $('#add_to_cart').submit(function(e){
    e.preventDefault();
   
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_to_cart')[0].reset();
        cart();
      }
    });
  });


//   Quantity increase and decrease button

		if($('.product_quantity').length)
		{
			var input = $('#quantity_input');
			var incButton = $('#quantity_inc_button');
			var decButton = $('#quantity_dec_button');

			var originalVal;
			var endVal;

			incButton.on('click', function()
			{
				originalVal = input.val();
				endVal = parseFloat(originalVal) + 1;
				input.val(endVal);
			});

			decButton.on('click', function()
			{
				originalVal = input.val();
				if(originalVal > 0)
				{
					endVal = parseFloat(originalVal) - 1;
					input.val(endVal);
				}
			});
		}
	

        </script>
    @endsection
		
	