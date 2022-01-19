@extends('layouts.admin')

@section('title','Return-Order')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Request For Return Order</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Order</li>
             <li class="breadcrumb-item active">Return Order</li>
           </ol>
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
                <h3 class="card-title">Return Order List</h3>
              </div>
            <div class="row">
            <div class="form-group col-3 mt-1" style="padding-left:20px;">
              		<label>Shop Name</label>
              		 <select class="form-control submitable" name="shopName" id="shopName">
                       <option value="">All</option>
              		 	  @foreach($shop as $row)
              		 	    <option value="{{$row->shop_name }}">{{ $row->shop_name }}</option>
              		 	  @endforeach  
  				
              		 </select>
              	</div>
                  <div class="form-group col-3 mt-1" style="padding-left:20px;">
              		<label>Return Status</label>
              		 <select class="form-control submitable" name="returnStatus" id="returnStatus">
              		 	<option value="">All</option>
              		 	    <option value="Pending">Pending</option>
  						    <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
  				
              		 </select>
              	</div>
            </div>
                <div class="card-body">
                @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <table  class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
            
                      <th>Order id/Reuest id</th>
                      <th>User Name</th>
                      <th>Product Name</th>
                      <th>Shop name </th>
                      <th>Return reason </th>
                      <th>Comment </th>
                      <th>Date</th>
                      <th>Status</th>
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



<!-- request order accept or reject -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve or Reject Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
        
     </div> 
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
	$(function returnOrder(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('return.order.index') }}", 
		        "data":function(e) { 
		          e.returnStatus =$("#returnStatus").val();
                  e.shopName =$("#shopName").val();
         
		        }
		      },
	
			columns:[
			
				{data:'order_id'  ,name:'order_id'},
        {data:'user_name'  ,name:'user_name'},
        {data:'product_name'  ,name:'product_name'},
        {data:'shop_name'  ,name:'shop_name'},
        {data:'return_reason'  ,name:'return_reason'},
        {data:'comment'  ,name:'comment'},
        {data:'date',name:'date'},
        {data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });


     // edit request status
	$('body').on('click','.edit', function(){
	    var id=$(this).data('id');
		var url = "{{ url('return_order/edit') }}/"+id;
		$.ajax({
	
			url:url,
			type:'get',
			success:function(data){  
	         $("#modal_body").html(data);
	      }
	  });
    });
</script>

@endsection