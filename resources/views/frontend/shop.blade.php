@extends('layouts.front_partial.districtnav')
 @section('content')
<style>
    
.search-container{
  width: 490px;
  display: block;
  margin: 0 auto;
}

input#search-bar{
  margin: 0 auto;
  width: 100%;
  height: 45px;
  padding: 0 20px;
  font-size: 1rem;
  border: 1px solid #D0CFCE;
  outline: none;
  &:focus{
    border: 1px solid #008ABF;
    transition: 0.35s ease;
    color: #008ABF;
    &::-webkit-input-placeholder{
      transition: opacity 0.45s ease; 
  	  opacity: 0;
     }
    &::-moz-placeholder {
      transition: opacity 0.45s ease; 
  	  opacity: 0;
     }
    &:-ms-placeholder {
     transition: opacity 0.45s ease; 
  	 opacity: 0;
     }    
   }
 }

.search-icon{
  position: relative;
  float: right;
  width: 75px;
  height: 75px;
  top: -62px;
  right: -45px;
}



.search-icon{
   padding-right:40px;
 

}
</style>
    <section>
        <div class="districtbanner mb-5 mt-5">
            <div class="row">
                <div class="col-md-5">
                <img class="distirct-banner" src="https://i2.wp.com/oristen.com/wp-content/uploads/2019/12/Best-Quality-products.png?fit=1024%2C492&ssl=1" alt="">
                </div>
                <div class="col-md-7 districtsearch mt-5">
                    <h2>Grocery delivery from {{$districtname}} best stores</h3>
                    <p>The meals you love, delivered with care</p>
                    <form class="search-container" action="{{route('shop.search')}}">
    <input type="text" id="search-bar" name="search_shop" placeholder="Search Your Shop..."  autocomplete="off" required="required">
<button class="search_shop btn btn-warning" type="submit">FIND SHOP</button>
   
  </form>

                </div>
            </div>
        
        </div>
    </section>
    <!-- all shop -->
    <div class="container shop pt-3 pb-5">
      @if($shops)
    <h4>Popular grocery store are here!</h4>
    @else
    <h4 class="text-center">Sorry..There is no availiable store in  {{$districtname}}  !</h4>
 

    @endif
    <div class="row">



        @foreach($shop as $row)
   
     
        <div class="col-md-3 mt-2">
      
           <div class=" card shopcontent">
      
              @if((int)$row->open_time <= (int)$currentTime && (int)$row->close_time>=(int)$currentTime)
              <a href="{{route('website.home',$row->shop_slug)}}"><img class="shopimg" src="{{asset($row->shop_photo)}}" alt=""></a>
               @else
               <img class="shopimg" src="{{asset($row->shop_photo)}}" alt="">
         
               @endif
          
               <p class="shopname">{{$row->shop_name}}</p>
   
            
               @foreach($shopreview as $review)
             
	@php
						$review_5=App\Models\ShopReview::where('shop_id',$row->id)->where('rating',5)->count();
						 $review_4=App\Models\ShopReview::where('shop_id',$row->id)->where('rating',4)->count();
						$review_3=App\Models\ShopReview::where('shop_id',$row->id)->where('rating',3)->count();
						$review_2=App\Models\ShopReview::where('shop_id',$row->id)->where('rating',2)->count();
						$review_1=App\Models\ShopReview::where('shop_id',$row->id)->where('rating',1)->count();
						$sum_rating=App\Models\ShopReview::where('shop_id',$row->id)->sum('rating');
                       $count_rating=App\Models\ShopReview::where('shop_id',$row->id)->count('rating');
                       @endphp
                       @endforeach    
                       {{-- review star --}}
					 <div>
        
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

             @else
             <p>(No Review)</p>
					@endif 

          @if((int)$row->open_time <= (int)$currentTime && (int)$row->close_time>=(int)$currentTime)
          @else
          <p class="text-danger close">Shop Is close now</p>
          @endif

       
					 </div>
         
           </div>
          
        </div>


        
     
        @endforeach
      
    </div>
</div>
    @endsection