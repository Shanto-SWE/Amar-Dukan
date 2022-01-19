@extends('layouts.shoper')
@section('shoper_content')


  <div class="content-wrapper">
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Orders</h1>
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
                <h3 class="card-title">All Order List </h3>
              </div><br>
        
           <div class="row">
        
     
              	<div class="form-group col-3" style="padding-left:25px">
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
            
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Total ({{ $setting->currency }})</th>
                      <th>Coupon Discount</th>
                      <th>After Discount ({{ $setting->currency }})</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Invoice</th>
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


<!-- order details model -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="view_modal_body">
        
     </div> 
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('shoper.order.index') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
		          e.date =$("#date").val();
		      
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'c_name'  ,name:'c_name'},
				{data:'c_phone'  ,name:'c_phone'},
        {data:'c_email'  ,name:'c_email'},
				{data:'total',name:'total'},
        {data:'coupon_discount',name:'coupon_discount'},
        {data:'after_discount',name:'after_discount'},
				{data:'date',name:'date'},
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



    //order edit
	$('body').on('click','.edit', function(){
	    var id=$(this).data('id');
		var url = "{{ url('shopkeeper/order/edit') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	         $("#modal_body").html(data);
	      }
	  });
    });

    //order view
	$('body').on('click','.view', function(){
	    var id=$(this).data('id');
		var url = "{{ url('shopkeeper/order/view') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	         $("#view_modal_body").html(data);
	      }
	  });
    });

   //  order invoice print
	$('body').on('click','.shoperOrderInvoice', function(){
    var id=$(this).data('id');
    var url = "{{ url('shopkeeper/order/print') }}/"+id;

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