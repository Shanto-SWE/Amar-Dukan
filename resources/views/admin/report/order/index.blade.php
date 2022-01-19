@extends('layouts.admin')

@section('title','All Orders')
@section('admin_content')


  <div class="content-wrapper">
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Orders</h1>
          </div>
      
        </div>
      </div>
    </div>
   
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Order List  </h3>
              </div><br>
        
           <div class="row">
           <div class="form-group col-3 px-3">
           <label>shop</label>
              		 <select class="form-control submitable" name="shop_name" id="shop_name">
              		 	<option value="">All</option>
              		 	  @foreach($shop as $row)
              		 	    <option value="{{$row->shop_name }}">{{ $row->shop_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
           <div class="form-group col-3">
              		<label>Payment Type</label>
              		 <select class="form-control submitable" name="payment_type" id="payment_type">
              		 	<option value="">All</option>
              		 	<option value="Hand Cash">Hand Cash</option>
  						<option value="Aamarpay">Aamarpay</option>
  			
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Date</label>
              		 <input type="date" name="date" id="date" class="form-control submitable_input">
              	</div>
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="6">All</option>
              		 	    <option value="0">Pending</option>
  							<option value="1">Recieved</option>
  							<option value="2">Shipped</option>
  							<option value="3">Completed</option>
  							<option value="4">Return</option>
  							<option value="5">Canccel</option>
              		 </select>
              	</div>
           </div>
     
              </div>
              <div class="row">
               <div class="col-12">
				   <button class="btn btn-primary printReport w-100"> <span class="loader d-none">Loading...</span> <span class="print">Print</span></button>
                 
               </div>
           </div>
            
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Shop_name</th>
                      <th>Total ({{ $setting->currency }})</th>
					  <th>Coupon Discount</th>
                      <th>After Discount ({{ $setting->currency }})</th>
                      <th>Payment Type</th>
                      <th>Date</th>
                      <th>Status</th>
               
                    </tr>
                    </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function order(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('order.report') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
		          e.date =$("#date").val();
		          e.payment_type =$("#payment_type").val();
                  e.shop_name =$("#shop_name").val();
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'c_name'  ,name:'c_name'},
				{data:'c_phone'  ,name:'c_phone'},
                {data:'shop_name'  ,name:'shop_name'},
				{data:'total',name:'total'},
				{data:'coupon_discount',name:'coupon_discount'},
                {data:'after_discount',name:'after_discount'},
				{data:'payment_type',name:'payment_type'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},	
			
			]
		});
	});


  


	//submitable class call for every change
  $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('change','.submitable_input', function(){
      $('.ytable').DataTable().ajax.reload();
  });

  


   
</script>
<script type="text/javascript">
	// print order report

$('.printReport').on('click',function(e){

e.preventDefault();
$('.loader').removeClass('d-none');
$('.print').addClass('d-none');

$.ajax({
	url:"{{route('report.order.print')}}",
	type:'get',
	data:{status:$('#status').val(),date:$('#date').val(),payment_type:$('#payment_type').val(),shop_name:$('#shop_name').val()},
	success:function(data){
	  $('.loader').addClass('d-none');
	  $('.print').removeClass('d-none');
	  $(data).printThis({
			   debug:false,
			   importCSS:true,
			   importStyle:true,
			   removeInline:false,
			   printDelay:500,
			   header:null,
			   footer:null,

	  });

	}
});


});
</script>
@endsection