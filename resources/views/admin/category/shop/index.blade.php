@extends('layouts.admin')

@section('title','Shop')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shop</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary mx-2" data-toggle="modal" data-target="#addModal"> + Add New</button>
              <a href="{{route('export.shop')}}"><button class="btn btn-primary"  style="float:right; padding-right:10px">Export Shop</button></a>
              
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
                <h3 class="card-title">All Shop list here  | &nbsp;<a href="{{route('shop.report.chart')}}">View Report</a></h3>
              </div>
          <div class="row">
            
          <div class="form-group col-3" style="padding-left:25px;">
           <label>District</label>
              		 <select class="form-control submitable" name="district_id" id="district_id">
              		 	<option value="">All</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->id }}">{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
                <div class="form-group col-3" style="padding-left:20px;">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="6">All</option>
              		 	    <option value="0">Inactive</option>
  						         	<option value="1">Active</option>
  				
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
                      <th>Owner_Photo</th>
                      <th>Owner_Name</th>
                       <th>Shop_Name</th>
                       <th>District</th>
                      <th>city</th>
                      <th>Area</th>
                      <th>Phone</th>
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


{{-- shop insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New shop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('shop.store') }}"  method="Post" id="add-form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="shop_name">shop Name</label>
            <input type="text" class="form-control"  name="shop_name"  placeholder="shop Name" required> 
          </div>
          <div class="form-group">
            <label for="shop_owner_name">Owner Name</label>
            <input type="text" class="form-control"  name="shop_owner_name"  placeholder="Owner name" required> 
          </div>
          <div class="form-group">
            <label for="shop_name">Owner Email</label>
            <input type="text" class="form-control"  name="shop_owner_email"  placeholder="Owner Email" required> 
          </div> 
          
          <div class="form-group">
            <label for="shop_district">shop district</label>
            <select class="form-control" name="district_id" required>
                      <option value="" >Select district</option>
                        @foreach($district as $row)
                          <option value="{{ $row->id }}">{{ $row->district_name  }}</option>
                        @endforeach
                      </select>
          </div>  
          <div class="form-group">
            <label for="city">shop city</label>
            <input type="text" class="form-control"  name="shop_city"  placeholder="shop city" required>
          </div>   

          <div class="form-group">
            <label for="shop_area">shop area</label>
            <input type="text" class="form-control"  name="shop_area"  placeholder="shop area" required>
          </div>   

          <div class="form-group">
            <label for="shop_phone">shop Phone</label>
            <input type="text" class="form-control"  name="shop_phone"  placeholder="shop Phone" required>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">shop another Phone</label>
            <input type="text" class="form-control"  name="shop_another_phone"  placeholder="shop another phone">
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Open Time</label>
            <input type="time" class="form-control"  name="open_time"  placeholder="open time">
     
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Close Time</label>
            <input type="time" class="form-control"   name="close_time"  placeholder="close time">
          </div> 
          <div class="form-group">
            <label for="shop_photo">Owner photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="owner_photo" required="">

          </div>  
          <div class="form-group">
            <label for="shop_photo">Shop photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="shop_photo" required="">
            <small id="emailHelp" class="form-text text-muted">This is your shop photo </small>
          </div>   
          <div class="form-group">
            <label for="shop_another_phone">Password</label>
            <input type="text" class="form-control"  name="password"  placeholder="password">
          </div> 
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Submit </span> </button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update shop</h5>
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
	$(function shop(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('shop.index') }}", 
		        "data":function(e) { 
              e.district_id =$("#district_id").val();
              e.status =$("#status").val();
         
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'shop_owner_photo',name:'shop_owner_photo', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"50\" width=\"50\" />";
				}},
        {data:'shop_owner_name'  ,name:'shop_owner_name'},
        {data:'shop_name'  ,name:'shop_name'},
				{data:'district_name',name:'district_name'},
        {data:'shop_city',name:'shop_city'},
        {data:'shop_area',name:'shop_area'},
				{data:'shop_phone',name:'shop_phone'},
        {data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});
  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

// edit shop
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("shop/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

 //form submit
 $('#add-form').on('submit',function(){
      $('.loader').removeClass('d-none');
      $('.submit_btn').addClass('d-none');
  });



  //deactive status
	$('body').on('click','.deactive_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('shop/not-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
          location.reload();
	      }
	  });
    });

    //Active status
	$('body').on('click','.active_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('shop/active-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
          location.reload();
	      }
	    });
    });


</script>

@endsection