@extends('layouts.admin')

@section('title','Categories')
@section('admin_content')


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> + Add New</button>
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
                <h3 class="card-title">All categories list here</h3>
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
                    <div class="row">
                    <div class="form-group col-3">
              		<label>shop</label>
              		 <select class="form-control submitable" name="shop_id" id="shop_id">
              		 	<option value="">All</option>
              		 	  @foreach($shop as $row)
              		 	    <option value="{{$row->id }}">{{ $row->shop_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
                    </div>
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Shop Name</th>
                      <th>Category Name</th>
                      <th>Category logo</th>
                      <th>Category thumbnail</th>
                      <th>Home_page</th>
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

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('category.store') }}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
      <div class="form-group">
      <label for="exampleInputEmail1">Shop Name <span class="text-danger">*</span> </label>
                      <select class="form-control" name="shop_id">
      
                        @foreach($shop as $row)
                         <option value="{{ $row->id }}">{{ $row->shop_name }}</option>
                        @endforeach 
                      </select>
   
          </div> 
          <div class="form-group">
            <label for="category_name">Category Name  <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" id="category_name" name="category_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main category</small>
          </div> 
          <div class="form-group">
            <label for="brand-name">Category Logo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="category_logo" required="">
            <small id="emailHelp" class="form-text text-muted">This is your category Logo </small>
          </div>  
          <div class="form-group">
            <label for="brand-name">Category thumbnail</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="category_thumbnail" >
            <small id="emailHelp" class="form-text text-muted">This is your category thumbnail </small>
          </div> 
          <div class="form-group">
          		  <label for="start-date">Home Page category</label>
          		  <select class="form-control" name="home_page" >
                  <option value="">Select one</option>
          		  	<option value="1">Active</option>
          		  	<option value="0">Inactive</option>
          		  </select>
                <small id="emailHelp" class="form-text text-muted">This is your home page category </small>
          		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body">
     		
         </div>	
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script type="text/javascript">
	$(function category(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
        "url": "{{ route('category.index') }}", 
        "data":function(e) {
          e.shop_id =$("#shop_id").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'shop_name'  ,name:'shop_name'},
				{data:'category_name'  ,name:'category_name'},
        {data:'category_logo',name:'category_logo', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"30\" />";
				}},
				{data:'category_thumbnail',name:'category_thumbnail', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"30\" />";
				}},
        {data:'home_page'  ,name:'home_page'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});


	$('body').on('click','.edit', function(){
		let cat_id=$(this).data('id');
		$.get("category/edit/"+cat_id, function(data){
      $("#modal_body").html(data);
		});
	});

    	//submitable class call for every change
      $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

</script>

@endsection