@extends('layouts.admin')

@section('title','E-Campaign')
@section('admin_content')



  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign</h1>
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
                <h3 class="card-title">All Campaign List </h3>
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
                    <th>Shop Name</th>
                      <th>Start Date</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Discount(%)</th>
                      <th>Status</th>
                      <th>End Date</th>
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
@php
$shop=DB::table('shops')->where('status',1)->get();

@endphp
{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('campaign.store') }}" method="Post" enctype="multipart/form-data" id="add-form">
      @csrf
      <div class="modal-body">
      <div class="form-group">
            <label for="brand-name">Shop Name <span class="text-danger">*</span> </label>
          <select name="shop_name" class="form-control">
            @foreach($shop as $row)
            <option value="{{$row->shop_name}}">{{$row->shop_name}}</option>
            @endforeach
          </select>
          </div>
          <div class="form-group">
            <label for="brand-name">Campaign Title <span class="text-danger">*</span> </label>
            <input type="text" class="form-control"  name="title" required="">
            <small id="emailHelp" class="form-text text-muted">This is campaign title/name </small>
          </div>
          <div class="row">
          	<div class="col-lg-6">
          		<div class="form-group">
          		  <label for="start-date">Start Date <span class="text-danger">*</span></label>
          		  <input type="date" class="form-control"  name="start_date" required="">
          		</div>
          	</div>
          	<div class="col-lg-6">
          		<div class="form-group">
          		  <label for="End-date">End Date <span class="text-danger">*</span></label>
          		  <input type="date" class="form-control"  name="end_date" required="">
          		</div>
          	</div>
          </div>
          <div class="row">
          	<div class="col-lg-6">
          		<div class="form-group">
          		  <label for="start-date">Status<span class="text-danger">*</span></label>
          		  <select class="form-control" name="status">
          		  	<option value="1">Active</option>
          		  	<option value="0">Inactive</option>
          		  </select>
          		</div>
          	</div>
          	<div class="col-lg-6">
          		<div class="form-group">
          		  <label for="End-date">Discount (%) <span class="text-danger">*</span></label>
          		  <input type="number" class="form-control"  name="discount" required="">
          		  <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all product selling price</small>

          		</div>
          	</div>
          </div>
           <div class="form-group">
            <label for="brand-name">Brand Logo <span class="text-danger">*</span></label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" required="">
            <small id="emailHelp" class="form-text text-muted">This is your campaign banner </small>
          </div>   
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
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
	$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('campaign.index') }}",
			columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'shop_name',name:'shop_name'},
				{data:'start_date',name:'start_date'},
				{data:'title'  ,name:'title'},
				{data:'image',name:'image', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"30\" />";
				}},
				{data:'discount',name:'discount'},
				{data:'status',name:'status'},
        {data:'end_date',name:'end_date'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});


  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("campaign/edit/"+id, function(data){
         $("#modal_body").html(data);
    });
  });



</script>

@endsection