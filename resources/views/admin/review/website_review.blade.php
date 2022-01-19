@extends('layouts.admin')

@section('title','Website_review')
@section('admin_content')



  <div class="content-wrapper">
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Website review</h1>
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
                <h3 class="card-title">All Website review List Here</h3>
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
                      <th>Name</th>
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
			ajax:"{{ route('website.review') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'name'  ,name:'name'},
				{data:'review',name:'review'},
                {data:'rating',name:'rating'},
                {data:'review_date',name:'review_date'},
			
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});





</script>

@endsection