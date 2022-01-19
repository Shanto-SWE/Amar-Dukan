@extends('layouts.shoper')
@section('shoper_content')


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Queston</h1>
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
                <h3 class="card-title">All Product Question </h3>
              </div><br>
              <div class="row p-2">  
        
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="2">All</option>
              		 	    <option value="1">Reply</option>
  							<option value="0">Pendding</option>
              		 </select>
              	</div>
              </div>
          
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Product_name</th>
					             <th>User_name</th>
                      <th>Question</th>
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

{{-- question answer modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Question</h5>
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
	$(function question(){
		table=$('.ytable').DataTable({
	"processing":true,
      "serverSide":true,
      "searching":true,
      "ajax":{
        "url": "{{ route('shoper.product.question') }}", 
        "data":function(e) {
          e.status =$("#status").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'name'  ,name:'name'},
        {data:'FullName'  ,name:'FullName'},
        {data:'question'  ,name:'question'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});

	 
    	//submitable class call for every change
        $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });


  // show product questioin

	$('body').on('click','.questionreply', function(){
		let id=$(this).data('id');
		$.get("product/question/show/"+id, function(data){
      $("#modal_body").html(data);
		});
 
	});


    </script>
@endsection