@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">



 

    @section('content')
    @include('layouts.front_partial.collaps_nav')


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            @isset($brand->brand_logo)
            <img src="{{asset($brand->brand_logo)}}"  class="img-fluid categoybanner "  alt="">
            <h4 class="mt-5">{{$brand->brand_name}}</h4>
            @endisset
           
            <hr>

        </div>
    </div>
</div>
                       @php
						$brands=DB::table('brands')->get();

						@endphp

<!-- all product -->
 <div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
					
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

								
								@forelse ($product as $row)
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"> <img  src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="{{ $row->name }}" height="100%" width="70%"></div>
												<div class="product_content">
												@if($row->discount_price==NULL)
                                                  <div class="product_price discount">{{ $setting->currency }}{{ $row->selling_price }}.00</div>
                                                @else
                                                  <div class="product_price discount">{{ $setting->currency }} {{ $row->discount_price }}.00<del class=fpdiscount>{{ $setting->currency }} {{ $row->selling_price }}.00</del></div>
                                                @endif  
													<div class="product_name"><div><a href="{{ route('product.details',$row->slug) }}">{{$row->name}}</a></div></div>
													<div class="product_extras mt-2">
											
														<button class="product_cart_button quick_view text-white" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter" ">Add to Cart</button>
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
										    @empty
                                            <h3>No Product Found</h3>
                                             @endforelse
					
									</div>
									<div class="arrivals_slider_dots_cover"></div>
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
					</div>
				</div>
			</div>
		</div>		
	</div> 

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
</script>
    @endsection