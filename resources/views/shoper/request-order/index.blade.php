@extends('layouts.shoper')
@section('shoper_content')



  <div class="content-wrapper">
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Request Orders</h1>
          </div>
          <div class="col-sm-6">
            
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
                <h3 class="card-title">All Request Order List </h3>
              </div><br>
        
           <div class="row">
    
              	<div class="form-group col-3"  style="padding-left:25px">
              		<label>Date</label>
              		 <input type="date" name="date" id="date" class="form-control submitable_input">
              	</div>
                  <div class="form-group col-3">
              		<label>Delivery Date</label>
              		 <input type="date" name="delivery_date" id="delivery_date" class="form-control submitable_input">
              	</div>
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="5">All</option>
              		 	    <option value="0">Recieved</option>
  							<option value="1">Shipped</option>
  							<option value="2">Completed</option>
  							<option value="3">Return</option>
  							<option value="4">Canccel</option>
              		 </select>
              	</div>
           </div>
              </div>
            
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Customer Name</th>
                      <th>Phone</th>
                      <th>Product Name</th>
                      <th>Weight</th>
                      <th>Quantity</th>
                      <th>Product Description</th>
                      <th>Date</th>
                      <th>Delivery Date</th>
                      <th>Status</th>
                      <th>print</th>
                      <th>Action</th>
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
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('shoper.request-order.index') }}", 
		        "data":function(e) { 
                    e.shop_id =$("#shop_id").val();
                    e.date =$("#date").val();
                    e.delivery_date =$("#delivery_date").val();
		          e.status =$("#status").val();
		       
		       
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'name',name:'name'},	
        {data:'phone',name:'phone'},	
        {data:'product_name',name:'product_name'},	
        {data:'product_weight',name:'product_weight'},
        {data:'product_quantity',name:'product_quantity'},	
        {data:'product_description',name:'product_description'},		
				{data:'date',name:'date'},
        {data:'delivery_date',name:'delivery_date'},
				{data:'status',name:'status'},
        {data:'print',name:'print'},		
				{data:'action',name:'action',orderable:true, searchable:true},
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



  
// request order invoice print
$('body').on('click','.shoperRequestOrderInvoice', function(){
    var id=$(this).data('id');
    var url = "{{ url('shopkeeper/request-order/print') }}/"+id;

    $.ajax({
	url:url,
	type:'get',
	success:function(data){
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