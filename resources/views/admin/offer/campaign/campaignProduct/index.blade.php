@extends('layouts.admin')

@section('title','Campaign_Products')
@section('admin_content')


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('campaign.product.create') }}" class="btn btn-primary" > + Add New</a>
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
                <h3 class="card-title">All Campaign Product List </h3>
              </div><br>
				 <div class="row">

                
				  <div class="form-group col-3 mx-3">
              		<label>Brand</label>
              		 <select class="form-control submitable" name="brand_id" id="brand_id">
              		 	<option value="">All</option>
              		 	  @foreach($brand as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
              
              	<div class="form-group col-3">
              		<label>shop</label>
              		 <select class="form-control submitable" name="shop_id" id="shop_id">
              		 	<option value="">All</option>
              		 	  @foreach($shop as $row)
              		 	    <option value="{{$row->id }}">{{ $row->shop_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="2">All</option>
              		 	    <option value="1">Active</option>
  							<option value="0">Inactive</option>
              		 </select>
              	</div>
              </div>
          
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Shop Name</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
					  <th>quantity\weight</th>
                      <th>Code</th>
                      <th>Discount price(TK)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                  <form id="deleted_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                  </form>
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
        "url": "{{ route('campaign.product') }}", 
        "data":function(e) {
          e.status =$("#status").val();
		  e.brand_id =$("#brand_id").val();
          e.shop_id =$("#shop_id").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'shop_name'  ,name:'shop_name'},
				{data:'thumbnail'  ,name:'thumbnail'},
				{data:'name'  ,name:'name'},
				{data:'quantity'  ,name:'quantity'},
				{data:'code'  ,name:'code'},
				{data:'discount_price',name:'discount_price'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});

	 






    //deactive status
	$('body').on('click','.deactive_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/not-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //Active status
	$('body').on('click','.active_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/active-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	    });
    });

</script>
    
<script type="text/javascript">
// Products delete

$(document).ready(function(){
	      $(document).on('click', '#delete_product',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $("#deleted_form").attr('action',url); 
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                 $("#deleted_form").submit();
              } else {
                 swal("Your imaginary file is safe!");
              }
            });
         });
     //data passed through here
     $('#deleted_form').submit(function(e){
          e.preventDefault();
          var url = $(this).attr('action');
          var request =$(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.success(data);
              $('#deleted_form')[0].reset();
               table.ajax.reload();
            }
          });
        });
      
    });
    	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  //   edit product

  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
	url="campaignProduct/edit/"+id;
	window.location.replace(url);
  
  });

    </script>


@endsection