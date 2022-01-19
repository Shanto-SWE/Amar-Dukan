@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">




    @section('content')
	
    @include('layouts.front_partial.collaps_nav')
    <div class="checkout-sectoin">

   
<div class="container mt-5 mb-5">
<div class="row mt-5 mb-5">
        <div class="col-md-8">
        
         <div class="card">
             <div class="card-header">
             <h3 class="text-center">Billing Address</h3>
             </div>
             <div class="card-body">
             <form action="{{route('order.place')}}" method="post" id="order_place">
               @csrf
                 <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
    <label for="exampleInputEmail1">Customer Name</label>
    <input type="text" class="form-control"  name="c_name" value="{{Session::get('user') ['FullName']}}" >

  </div>
  <div class="form-group">
  <label>District</label>
              		 <select class="form-control " name="c_city" id="district_id" style="min-width: 340px; margin-left: -4px;" required>
              		 	<option value="" >select district</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->district_name }}"  >{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Shipping Address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="c_address"   aria-describedby="emailHelp" required >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Customer phone</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="c_phone"   aria-describedby="emailHelp" required>

  </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
    <label for="exampleInputEmail1">Customer Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="c_email"  aria-describedby="emailHelp" required>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1"> Shipping Area</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="c_area"   aria-describedby="emailHelp" required >

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Extra Phone</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="c_extra_phone"   aria-describedby="emailHelp" required>

  </div>
                     </div>
                 </div>
                 <hr>
 <h3 class="mb-4">Payment method</h3>
          
<div class="check">
<input type="radio"  name="payment_type" checked="" value="Aamarpay" >
<label>Bkash/Rocket/Nagad </label>

           </div>
           <div class="check">
           <input type="radio"  name="payment_type"  value="Hand Cash" >
           <label>Hand Cash</label>
					

           </div>
<br>
 <button type="submit" class="btn btn-primary w-100 order mt-4">Order place</button>
 <button type="submit" class="btn btn-primary d-none w-100 lodding mt-4">Lodding....</button>

<br>


</form>
             </div>
         </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="pl-3 pt-2">
                    <p >Subtotal: <span style="float:right; padding-right:10px">{{Cart::subtotal()}}{{$setting->currency}}</span></p>
                    @if(Session::has('coupon'))
                    <p>Coupon Code:<span style="float:right; padding-right:10px"> ({{Session::get('coupon')['name']}}) <a class="coupondelete" href="{{route('coupon.remove')}}">X</a></span></p>
                    @endif
                    <p>Tax:<span style="float:right; padding-right:10px"> 00.00 %</span> </p>
                    <p>Shipping Cost:<span style="float:right; padding-right:10px" id="shipping_cost"></span></p>
                
                    @if(Session::has('coupon'))
                    <p class="text-dark">Coupon Discount:<span style="float:right; padding-right:10px">{{Session::get('coupon')['discount']}}{{Session::get('coupon')['coupon_type']}}</span> </p>
                    <p class="text-dark">Total:<span style="float:right; padding-right:10px" id="shippingcost"></span><span style="float:right; padding-right:10px">{{Session::get('coupon')['after_discount']}}{{$setting->currency}}</span> </p>
                    @else
                    <p class="text-dark">Total: <span style="float:right; padding-right:10px" id="shippingcost"></span><span style="float:right; padding-right:10px">{{Cart::total()}}{{$setting->currency}}</span> </p>

                    @endif
                    
                </div><hr>
                <div class="coupon p-4">
                    @if(!Session::has('coupon'))
                    <form action="{{route('apply.coupon')}}" method="post">
                    @csrf
                    <div class="form-group">
    <label for="exampleInputEmail1">Coupon Apply</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="coupon" placeholder="coupon code" autocomplete="off" aria-describedby="emailHelp" required>

    <div class="form-group">
    <input type="submit" class="btn btn-primary mt-4" value="Apply Coupon"></input>

  </div>

                    </form>
                    @endif

                </div>
            </div>
            </div>
    </div>
</div>
</div>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
  
  $('#order_place').submit(function() {
    $('.lodding').removeClass('d-none');
    $('.order').addClass('d-none');
        });


   //ajax request send for collect shipping cost district wish
   $("#district_id").change(function(){
      var districtName = $(this).val();
      $.ajax({

           url: "{{ url("/get-shipping_cost/") }}/"+districtName,
           type: 'get',
           success: function(data) {
               console.log(data);    
               $('#shipping_cost').html(data+'{{$setting->currency}}');  
               $('#shippingcost').html('+'+data+'{{$setting->currency}}');  
               
                  }
        });
     });

</script>

    @endsection

