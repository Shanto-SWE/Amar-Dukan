@extends('layouts.admin')

@section('title','Shipping Cost')
@section('admin_content')


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shipping Cost</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#shippingModal"> + Add New</button>
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
                <h3 class="card-title">Shipping cost list here</h3>
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
              		<label>District</label>
              		 <select class="form-control submitable" name="district_id" id="district_id">
              		 	<option value="">All</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->id }}">{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
                    </div>
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>District Name</th>
                      <th>Shipping Cost(TK)</th>
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


{{-- shipping cost insert modal --}}
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{route('shipping_cost.store')}}" method="Post" enctype="multipart/form-data" id="add-form">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="brand-name">District  Name</label>
            <select class="form-control submitable" name="district_id" id="district_id">
              		 	<option value="">All</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->id }}">{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>

          </div>
          <div class="form-group">
            <label for="brand-name">Shipping Cost</label>
            <input type="text" class="form-control"  name="shipping_cost" required="">

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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Shipping Cost</h5>
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
	$(function shippingCost(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
        "url": "{{ route('shipping-cost.index') }}", 
        "data":function(e) {
          e.district_id =$("#district_id").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'district_name'  ,name:'district_name'},
				{data:'shipping_cost'  ,name:'shipping_cost'},
         {data:'status'  ,name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

// edit shipping cost
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("shipping-cost/edit/"+id, function(data){
         $("#modal_body").html(data);
    });
  });

    	//submitable class call for every change
      $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

</script>

@endsection