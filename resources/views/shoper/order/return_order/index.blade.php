@extends('layouts.shoper')
@section('shoper_content')
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
                
                  <table  class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                    <th>SL</th>
                      <th>Order id/Reuest id</th>
                      <th>User Name</th>
                      <th>Product Name</th>
                      <th>Return reason </th>
                      <th>Comment </th>
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
	$(function returnOrder(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('shopkeeper.return.order.index') }}", 
		        "data":function(e) { 
		          e.returnStatus =$("#returnStatus").val();
               
         
		        }
		      },
	
			columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
		   {data:'order_id'  ,name:'order_id'},
        {data:'user_name'  ,name:'user_name'},
        {data:'product_name'  ,name:'product_name'},
        {data:'return_reason'  ,name:'return_reason'},
        {data:'comment'  ,name:'comment'},
        {data:'date',name:'date'},
        {data:'status',name:'status'},
		

			]
		});
	});

  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });


  
</script>

@endsection