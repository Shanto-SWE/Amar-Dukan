@extends('layouts.admin')

@section('title','District')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">District</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
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
                <h3 class="card-title">District list | &nbsp;<a href="{{route('district.shop.report')}}">View Shop Report</a></h3>
              </div>
              <div class="form-group col-3" style="padding-left:20px;">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="6">All</option>
              		 	    <option value="0">Inactive</option>
  						         	<option value="1">Active</option>
  				
              		 </select>
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
                      <th>SL</th>
                      <th>District Name</th>
                      <th>District Photo</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New District</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('district.store') }}"  method="Post" id="add-form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="shop_name">District Name</label>
            <input type="text" class="form-control"  name="district_name"  placeholder="District Name" required> 
          </div> 
         
          <div class="form-group">
            <label for="shop_photo">District photo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="district_photo" required="">
            <small id="emailHelp" class="form-text text-muted">This is your district photo </small>
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
	$(function district(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('district.index') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
         
		        }
		      },
	
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'district_name'  ,name:'district_name'},
               {data:'district_photo',name:'district_photo', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"30\" />";
				}},
        {data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});
  
// edit shop
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("district/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

 //form submit
 $('#add-form').on('submit',function(){
      $('.loader').removeClass('d-none');
      $('.submit_btn').addClass('d-none');
  });
  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });
</script>

@endsection