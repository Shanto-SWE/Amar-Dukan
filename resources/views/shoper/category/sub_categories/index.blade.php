@extends('layouts.shoper')
@section('shoper_content')

  <div class="content-wrapper">
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Category</h1>
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
                <h3 class="card-title">All sub-categories list here</h3>
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
              
                <label for="category_name">Category Name  </label>
  
                <select class="form-control submitable" name="category_id" id="category_id">
              		 	<option value="">All</option>
              		 	  @foreach($category as $row)
              		 	    <option value="{{$row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach  
              		 </select>
                         
                      </select>
              	</div>
                    </div>
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                     <thead>
                    <tr>
                      <th>SL</th>
                      <th>Sub-Category Name</th>
                      <th>Category Name</th>
                      <th>Sub-Category logo</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New SubCategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('shoper.subcategory.store') }}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
  
      	  <div class="form-group">
          <label for="category_name">Category Name</label>
          <select class="form-control submitable" name="category_id" id="category_id">
              		 	<option value="">All</option>
              		 	  @foreach($category as $row)
              		 	    <option value="{{$row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach  
              		 </select>
                  
          </div>
          <div class="form-group">
            <label for="category_name">SubCategory Name</label>
            <input type="text" class="form-control"  name="subcategory_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your sub category</small>
          </div> 
          <div class="form-group">
            <label for="brand-name">Subcategory Logo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="subcategory_logo" required="">
            <small id="emailHelp" class="form-text text-muted">This is your category Logo </small>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Subategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
     		
     </div>	
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(function sub_category(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
        "url": "{{ route('shoper.subcategory.index') }}", 
        "data":function(e) {
          e.category_id =$("#category_id").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'Subcategory_name'  ,name:'Subcategory_name'},
				{data:'category_name'  ,name:'category_name'},
				{data:'subcat_logo',name:'subcat_logo', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"30\" />";
				}},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  // edit subcategory
	$('body').on('click','.edit', function(){
		let subcat_id=$(this).data('id');
		$.get("shopkeeper/subcategory/edit/"+subcat_id, function(data){
			$("#modal_body").html(data);
		});
	});
   //ajax request send for collect category for create subcategory
   $("#shopid").change(function(){
      var id = $(this).val();
   
      $.ajax({
           url: "{{ url("/get-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="category_id"]').empty();
                $('select[name="category_id"]').append('<option value="">'+ 'All' +'</option>');
                   $.each(data, function(key,data){
                      $('select[name="category_id"]').append('<option value="'+ data.id +'">'+ data.category_name +'</option>');
                });
           }
        });
     });

    //ajax request send for collect category for search category
    $("#shop_id").change(function(){
      var id = $(this).val();
   
      $.ajax({
           url: "{{ url("/get-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="category_id"]').empty();
                $('select[name="category_id"]').append('<option value="">'+ 'All' +'</option>');
                   $.each(data, function(key,data){
                      $('select[name="category_id"]').append('<option value="'+ data.id +'">'+ data.category_name +'</option>');
                });
           }
        });
     });

   	//submitable class call for every change
     $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });
</script>

@endsection