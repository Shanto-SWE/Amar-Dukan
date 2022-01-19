@extends('layouts.admin')

@section('title','Subscriber')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Newsletter Subscribers</h1>
          </div>
         
          <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Newsletter Subscriber</li>
       
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
                <h3 class="card-title">All Subscribers list</h3>
                <button class="btn btn-primary"  style="float:right; padding-right:10px">Export</button>
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
                      <th>Id</th>
                      <th>Email</th>
                      <th>Subscried on</th>
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
		        "url": "{{ route('subscriber.index') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
         
		        }
		      },
	
			columns:[
			
				{data:'id'  ,name:'id'},
                {data:'email'  ,name:'email'},
                {data:'date'  ,name:'date'},
                 {data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});
  
 


  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

    //deactive status
	$('body').on('click','.deactive_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('subscriber/deactive-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        $('.ytable').DataTable().ajax.reload();
	      }
	  });
    });

    //Active status
	$('body').on('click','.active_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('subscriber/active-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
            $('.ytable').DataTable().ajax.reload();
	      }
	    });
    });
</script>



@endsection