@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">




    @section('content')
    @include('layouts.front_partial.collaps_nav')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{asset($category_logo->category_thumbnail)}}"  class="img-fluid categoybanner "  alt="">
            <h4 class="mt-4">{{$category_logo->category_name}}</h4>
            <hr>

        </div>
    </div>
</div>
<!-- all subcategory -->
<div class="container pt-3 pb-5">
    <div class="row">
        @foreach($allsubcategory as $row)
     
        <div class="col-lg-2 col-md-3 col-4">
        <a href="{{route('categorywishproduct.show',$row->Subcat_slug)}}">
            <div class="card allsubcate">
                <div class="card-body">
                    <img src="{{asset($row->subcat_logo)}}"  class="img-fluid allsubcateimg" alt="">
                   
                </div>
                <p class="text-center">{{$row->Subcategory_name}}</p>
            </div>
            </a>
        </div>
     
        @endforeach
      
    </div>
</div>

    @endsection