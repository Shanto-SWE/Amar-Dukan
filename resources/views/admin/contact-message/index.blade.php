@extends('layouts.admin')

@section('title','Contact-Message')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contact Message</h1>
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
                <h3 class="card-title">Contact message list </h3>
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
                      <th>Name</th>
                      <th>Email</th></th>
                      <th>Phone</th>
                      <th>Message</th>
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
	$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
            ajax:"{{ route('contact.message') }}",
	
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'name'  ,name:'name'},
                 {data:'email',name:'email'},
                 {data:'phone',name:'phone'},
                 {data:'message',name:'message'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});
  



</script>

@endsection