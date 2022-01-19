@extends('layouts.admin')

@section('title','Shop_review')
@section('admin_content')



  <div class="content-wrapper">
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shop review</h1>
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
                <h3 class="card-title">All Shop review List Here</h3>
              </div>
              <div class="row mt-3">
              <div class="form-group col-3 " style="padding-left:25px">
              		<label>Shop Name</label>
              		 <select class="form-control submitable" name="shop_id" id="shop_id">
              		 	<option value="">All</option>
              		 	  @foreach($shop as $row)
              		 	    <option value="{{$row->id }}">{{ $row->shop_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
                <div class="form-group col-3" >
              		<label>Rating</label>
              		 <select class="form-control submitable"  id="rating">
              		 	<option value="6">All</option>
              		<option value="1">1</option>
  							<option value="2">2</option>
  							<option value="3">3</option>
  							<option value="4">4</option>
                <option value="5">5</option>
  					
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
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Customer_name</th>
                      <th>Shop_name</th>
                      <th>Review</th>
                      <th>Rating</th>
                      <th>Review date</th>
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
	$(function brand(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('shop.review') }}", 
		        "data":function(e) { 
		          e.shop_id =$("#shop_id").val();
              e.rating =$("#rating").val();
         
         
		        }
		      },

			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'name'  ,name:'name'},
        {data:'shop_name'  ,name:'shop_name'},
				{data:'review',name:'review'},
        {data:'rating',name:'rating'},
        {data:'review_date',name:'review_date'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

    	//submitable class call for every change
      $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });



</script>

@endsection