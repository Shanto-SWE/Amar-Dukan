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
        <div class="districtbanner mb-5  mt-5">
            <div class="row">
                <div class="col-md-5">
                <img class="distirct-banner" src="https://www.pngkey.com/png/detail/702-7029407_groceries-png.png" alt="">
                </div>
                <div class="col-md-7 districtsearch mt-5">
                    <h2>It's the groceries you love, delivered</h3>
                    <form class="search-container" action="{{route('district.search')}}">
    <input type="text" id="search-bar" name="search_district" placeholder="Search Your District..."  autocomplete="off">
<button class="search_dis btn btn-warning" type="submit">FIND DISTRICT</button>
   
  </form>



                </div>
            </div>
        
        </div>
    </section>

    <div class="row mb-5 listshopbanner">
      <div class="container mb-3">
      <h2> You prepare the grocery, we handle the rest</h3>
      </div>

      <div class="col-md-12 shopregbanner  mb-5">
        <img class="shoperregbannger" src="https://www.websoptimization.com/blog/wp-content/uploads/2020/06/banner.jpg" alt="">

        <div class="listshop">
          <p class="list">List your grocery shop on Amar Dukan</p>
          <p>Would you like millions of new customers to enjoy your groceries? So would we!</p>
       
          <p>It's simple: we list your menu and product lists online, help you process orders, pick them up, and deliver them  – in a heartbeat!</p>
   
          <p>Interested? Let's start our partnership today!</p>
          <a href="{{route('shoper.registration')}}" class="btn btn-warning getstare">GET STARTED</a>
        </div>
      </div>

    </div>
<section class="district mb-5 mt-5">

<div class="container mt-5">
@if($single_name)
<h4>Search result for {{$district_name}} district!</h4>
@else
<h4 class="text-center">Sorry!.. No district found</h4>
@endif
<div class="row">
 
    @foreach($data as $row)

    <div class="col-md-3">
        <div class="discard">
          
            <a href="{{route('shop.show',$row->district_slug)}}"><img class="disrictphoto" src="{{asset($row->district_photo)}}" alt=""></a>
     
            <div class="disname">
                <p>{{$row->district_name}}</p>
            </div>
         
        </div>
    </div>
 
    @endforeach
 
</div>
</div>
</section>
    @endsection