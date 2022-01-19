
     <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="">
                    <img src="{{ asset('storage/files/products/'.$product->thumbnail) }}" height="100%" width="100%">
                </div>
              </div>
              <div class="col-lg-8 ">
             
                <h2>{{ $product->name }}</h2>
                 <p>{{$product->quantity}}</p>
                 <p>Stock: @if($product->stock_quantity<1) <span class="badge badge-danger">Stock Out</span> @else <span class="badge badge-success">Stock Available</span> @endif </p>
                 <div class="">
                        @if($product->discount_price==NULL)
			             <div class="">Price: {{ $setting->currency }}{{ $product->selling_price }}</div>
			            @else
			              <div class="" >
			              Price: <del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del class="text-danger">
			              	{{ $setting->currency }}{{ $product->discount_price }}</div>
			            @endif
  
              	</div>
                <form action="{{route('add.to.cartqv')}}" method="post" id="add_form">
                  @csrf
                  <input type="hidden" name="id" value="{{$product->id}}">
                  <input type="hidden" name="name" value="{{$product->name}}">
                  @if($product->discount_price==NULL)
                  <input type="hidden" name="price" value="{{$product->selling_price}}">
                  @else
                  <input type="hidden" name="price" value="{{$product->discount_price}}">
                  @endif

                <div class="  mt-2">
									<span>Quantity: </span>
									<input id="quantity" type="number" name="qty" pattern="[1-9]*" min="1" value="1">
								
								</div>
              	<br>
                 <div class="order_info d-flex flex-row">
                
                       
                        <div class="button_container">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                              	@if($product->stock_quantity<1)
                              	<span class="text-danger">Stock Out</span>
                              	@else
                                <button class="btn btn-sm btn-outline-info" type="submit" style="float: right;">Add to cart</button>
                                @endif
                              </div>
                            </div>
                        </div>
                        
                    </form>
                 </div>
              </div>
            </div>
          </div>
        </div>

        <script>
     //store item to cart
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
        toastr.success(data);
        $('#add_form')[0].reset();
        cart();
      }
    });
  });

        </script>