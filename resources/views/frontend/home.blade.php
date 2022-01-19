	
@extends('layouts.app')
@section('title','Home')
@section('navbar')
    @include('layouts.front_partial.main_nav')
    @endsection
  
@section('content')
<div class="banner">
		<div class="banner_background" style="background-image:url({{asset('frontend')}}/images/banner_background.jpg)"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				@isset($bannerproduct->product_slider)
				<div class="banner_product_image"><img  class="bannerimg" src="{{ asset('storage/files/products/'.$bannerproduct->thumbnail) }}" alt=""></div>
			
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">{{$bannerproduct->name}}</h1>
						<p>{{$bannerproduct->quantity}}</p>
						@if($bannerproduct->discount_price==NULL)
                         <div class="banner_price" style="margin-top: 30px;">{{ $setting->currency }}{{ $bannerproduct->selling_price }}.00</div>
                        @else
                          <div class="banner_price" style="margin-top: 30px;"><span>{{ $setting->currency }}{{ $bannerproduct->selling_price }}.00</span>{{ $setting->currency }}{{ $bannerproduct->discount_price }}.00</div>
                        @endif
						<div class="banner_product_name">{!!$bannerproduct->description!!}</div>
						<div class="button banner_button"><a href="{{ route('product.details',$bannerproduct->slug) }}"><i class="fas fa-cart-plus"></i> Shop Now</a></div>
					</div>
				</div>
				@endisset
			</div>
		</div>
	</div>
<!-- campaign show-->
@isset($campaign)
<div class="container mt-5 campaign">
	<div class="row">
		<div class="header">
		<h3 class="text-center">{{$campaign->title}}</h3>
		</div>
		<div class="col-md-6">
        <img src="{{ asset($campaign->image) }}" class="img-fluid" alt="">
		</div>
		<div class="col-md-6  mt-5 offersec">
        
			  <h3 class="text-center">Limited time offer -Hurry Up!</h3>
			
			  <div class="off mt-5 text-center">
				  <p>UP TO</p>
				  <h4>{{$campaign->discount}}%</h4>
				  <p>OFF</p>
		  </div>
		
		  <a class="btn btn-warning text-center mt-4" href="{{route('campaign.product.show',$campaign->title)}}"><i class="fas fa-cart-plus"></i> Shop Now</a>
		</div>
		
	</div>
</div>
@endisset
<!-- product category -->
<div class="allcategories mb-5 pt-4" id="productall">
		<div class="container">
		
            <h3>PRODUCT CATEGORIES</h3>
			<div class="row pt-2">

			
				@foreach($category as $row)
		
				<div class="col-lg-3 col-md-6 char_col">
				<a href="{{route('subcategorylist.show',$row->category_slug)}}">
					<div class="char_item d-flex flex-row align-items-center justify-content-between">
		
                  
						<div class="char_content">
							<div class="char_title">{{$row->category_name}}</div>
						</div>
                        <div class="char_icon"><img class="cateimg" src="{{asset($row->category_logo)}}" alt=""></div>
                      
					</div>
					</a>
				</div>
		
				@endforeach
               
		
			</div>
		</div>
	</div>


	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					
				

					<div class="deals">
						<div class="deals_title">Deals of the Week</div>
						<div class="deals_slider_container">
							
						
							<div class="owl-carousel owl-theme deals_slider">
								
					@foreach($today_deal  as $row)
								<div class="owl-item deals_item">
									<div class="deals_image"><img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt=""></div>
									<div class="deals_content">
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_category"><a href="#">{{$row->subcategory->Subcategory_name}}</a></div>
											<div class="deals_item_price_a ml-auto">
										
											<del>{{ $setting->currency }}{{ $row->selling_price }}.00</del>
										
											</div>
										</div>
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_name"><a href="{{ route('product.details',$row->slug) }}" class="todaydealname">{{$row->name}}</a></div>
											<div class="deals_item_price ml-auto">
									
											{{ $setting->currency }}{{ $row->discount_price }}.00
										
											</div>
										</div>
										<div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>{{ $row->stock_quantity }}{{$row->unit}}</span></div>
                                          
                                            </div>
                                           
										
										
                                        </div>
									
									</div>
								</div>

								@endforeach

							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>
					
			
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Featured Item</li>
									<li>Popular Item</li>
							
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

						
							<div class="product_panel panel active">
								<div class="featured_slider slider">

								@foreach($featured as $row)
                              
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="{{ $row->name }}" height="100%" width="70%">
                                            </div>
                                            <div class="product_content">
                                                @if($row->discount_price==NULL)
                                                  <div class="product_price discount">{{ $setting->currency }}{{ $row->selling_price }}.00</div>
                                                @else
                                                  <div class="product_price discount">{{ $setting->currency }} {{ $row->discount_price }}.00<del class="fpdiscount">{{ $setting->currency }} {{ $row->selling_price }}.00</del></div>
                                                @endif  
                                                <div class="product_name"><div>
                                                    <a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}..</a></div>
                                                </div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                   
                                                    </div>
                                                    <button class="product_cart_button  quick_view text-white" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('add.wishlist',$row->id) }}">
                                               <div class="product_fav">
                                                  <i class="fas fa-heart"></i>
                                               </div>
                                            </a>

											<!-- discount price  -->
											
											@php
											

											$discount_price=$row->discount_price;
											$selling_price=$row->selling_price;

											$off=(int)$selling_price-(int)$discount_price;


										

											@endphp

											@if($row->discount_price)
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount "><p>{{$off}} tk off</p></li>
                                                
                                            </ul>
											@endif
                                        </div>
                                    </div>
                                    @endforeach


								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- popular items section -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

								@foreach($popular_product as $row)
                               
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="{{ $row->name }}" height="100%" width="70%">
                                            </div>
                                            <div class="product_content">
                                                @if($row->discount_price==NULL)
                                                  <div class="product_price discount">{{ $setting->currency }}{{ $row->selling_price }}.00</div>
                                                @else
                                                  <div class="product_price discount">{{ $setting->currency }} {{ $row->discount_price }}.00<del class=fpdiscount>{{ $setting->currency }} {{ $row->selling_price }}.00</del></div>
                                                @endif  
                                                <div class="product_name"><div>
                                                    <a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}..</a></div>
                                                </div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                       
                                                    </div>
                                                    <button class="product_cart_button quick_view text-white" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('add.wishlist',$row->id) }}">
                                               <div class="product_fav">
                                                  <i class="fas fa-heart"></i>
                                               </div>
                                            </a>
                                           	<!-- discount price  -->
											
											@php
											

											$discount_price=$row->discount_price;
											$selling_price=$row->selling_price;

											$off=(int)$selling_price-(int)$discount_price;


											@endphp

											@if($row->discount_price)
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount "><p>{{$off}} tk off</p></li>
                                                
                                            </ul>
											@endif
                                        </div>
                                    </div>
                                    @endforeach

								

								</div>
								<div class="featured_slider_dots_cover "></div>
							</div>

						
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Hot New Arrivals -->
@isset($home_page_products->thumbnail)
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">{{$home_page->category_name}}</div>
							<ul class="clearfix">
							<li class=""></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

								
								@foreach($home_page_product as $row)
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"> <img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="{{ $row->name }}" height="100%" width="70%"></div>
												<div class="product_content">
												@if($row->discount_price==NULL)
                                                  <div class="product_price discount">{{ $setting->currency }}{{ $row->selling_price }}.00</div>
                                                @else
                                                  <div class="product_price discount">{{ $setting->currency }} {{ $row->discount_price }}.00<del class=fpdiscount>{{ $setting->currency }} {{ $row->selling_price }}.00</del></div>
                                                @endif  
													<div class="product_name"><div><a href="{{ route('product.details',$row->slug) }}">{{$row->name}}</a></div></div>
													<div class="product_extras mt-2">
												
														<button class="product_cart_button quick_view text-white" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
													</div>
												</div>
												<a href="{{ route('add.wishlist',$row->id) }}">  
                                               <div class="product_fav">
                                                  <i class="fas fa-heart"></i>
                                               </div>
											    </a>

											<!-- discount price  -->
											
											@php
											
											$discount_price=$row->discount_price;
											$selling_price=$row->selling_price;

											$off=(int)$selling_price-(int)$discount_price;

											@endphp

											@if($row->discount_price)
											   <ul class="product_marks">
                                                 
                                                    <li class="product_mark product_new"><p>{{$off}} tk off</p></li>
                                                </ul>
                                         
												@endif
											</div>
										</div>
                                @endforeach
					
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>


							</div>

						

						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>
@endisset

	<!-- Product for you -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Products for you</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<div class="owl-carousel owl-theme viewed_slider">
					 @foreach($random_product as $row)
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img class="foryouproduct" src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">
									     
										@if($row->discount_price==NULL)
									   {{ $setting->currency }}{{ $row->selling_price }}
									   @else
									   {{ $setting->currency }} {{ $row->discount_price }}
									   <del class="delprice">{{ $setting->currency }} {{ $row->selling_price }}</del>
									   @endif
										</div>
										<div class="viewed_name"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}..</a></div>
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
	<!-- Reviews -->

	<div class="reviews">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="reviews_title_container">
						<h3 class="reviews_title">Customer Reviews</h3>
		
					</div>

					<div class="reviews_slider_container">
						
				
						<div class="owl-carousel owl-theme reviews_slider">
							
							<!-- Reviews Slider Item -->

							@foreach($websitereview as $row)
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div><div class="review_image"><img src="{{asset($row->user->photo)}}" class="webreviewimg" alt=""></div></div>
									<div class="review_content">
										<div class="review_name">{{$row->name}}</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating">
											@if($row->rating == 5)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    @elseif($row->rating == 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                    @elseif($row->rating == 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    @elseif($row->rating == 2)
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
											</div>
											<div class="review_time">{{$row->review_date}}</div>
										</div>
										<div class="review_text"><p></p>{{ substr($row->review,0,110) }}..</p></div>
									</div>
								</div>
							</div>

						@endforeach
						
						

						</div>
						<div class="reviews_dots"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
				<h3 class="viewed_title">Brand</h3>
					<div class="brands_slider_container">

						<div class="owl-carousel owl-theme brands_slider">
						@foreach($brands as $row)
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><a href="{{route('brand.product',$row->id)}}"><img class="brandlogo" src="{{asset($row->brand_logo)}}" alt=""></a></div></div>
							@endforeach

						</div>
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- payment system -->

		<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
				<h3 class="viewed_title">PAYMENT OPTIONS</h3>
					<div class="brands_slider_container">
						
					

						<div class="owl-carousel owl-theme brands_slider">
				
							
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center"><img class="paymantlogo"  src="https://www.logo.wine/a/logo/BKash/BKash-bKash-Logo.wine.svg"alt="">
								</div>
							</div>
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center"><img class="paymantlogo"  src="https://download.logo.wine/logo/Nagad/Nagad-Logo.wine.png"alt="">
								</div>
							</div>
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center"><img class="paymantlogo"  src="https://bestlistbd.com/wp-content/uploads/classified-listing/2021/06/56191305_1074649016065535_8893606934653960192_n-4.jpg"alt="">
								</div>
							</div>
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center"><img class="paymantlogo amarpay"  src="https://www.aamarpay.com/images/logo/aamarpay_logo.png"alt="">
								</div>
							</div>
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center"><img class="paymantlogo"  src="https://img2.pngio.com/cash-on-delivery-png-5-png-image-cash-on-delivery-png-350_200.png"alt="">
								</div>
							</div>
						
						
						

						</div>
						
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>
	    <!-- Newsletter -->

		<div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
			

                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="{{ asset('public/frontend') }}/images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text"><p>Get the most update from our site and be updated your self..</p></div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="{{route('store.newsletter')}}" method="post" id="newsletter" class="newsletter_form">
								@csrf
                                <input type="email" name="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                <button class="newsletter_button" type="submit">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- quick view modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="quick_view_body">

      </div>
    </div>
  </div>
</div>

	<script type="text/javascript">
	    //ajax request for quick view
     $(document).on('click', '.quick_view', function(){ 
      var id = $(this).attr("id");
	  $.ajax({
           url: "{{ url("/product-quick-view/") }}/"+id,
           type: 'get',
           success: function(data) {
                $("#quick_view_body").html(data);
           }
        });
 
     });

	      //store newsletter by ajax
		  $('#newsletter').submit(function(e){
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
			$('#newsletter')[0].reset();

		  
	
		
  
      }
    });
  });

</script>

    @endsection