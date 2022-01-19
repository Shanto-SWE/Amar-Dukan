@extends('layouts.admin')

@section('title','User')
@section('admin_content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
                <h3 class="card-title">All Customer list here | &nbsp;<a href="{{route('customer.report.chart')}}">View Report</a></h3>
                <a href="{{route('export.user')}}"><button class="btn btn-primary"  style="float:right; padding-right:10px">Export User</button></a>
              </div>
          
                <div class="card-body">
                  <table class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>FullName</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Delivery Zone</th>
                      <th>Delivery Area</th>
                      <th>Delivery Address</th>
                      <th>Registration_date</th>
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
	$(function childcategory(){
		  table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('user.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'FullName'  ,name:'FullName'},
        {data:'email'  ,name:'email'},
        {data:'phone'  ,name:'phone'},
        {data:'delivery_zone'  ,name:'delivery_zone'},
        {data:'delivery_area'  ,name:'delivery_area'},
        {data:'delivery_address'  ,name:'delivery_address'},
        {data:'registration_date'  ,name:'registration_date'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});



 




// customer delete

$(document).ready(function(){
	      $(document).on('click', '#delete_customer',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $("#deleted_form").attr('action',url);
            swal({
                title: "Are you want to delete?",
                text: "Once Delete, This will be Permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                 $("#deleted_form").submit();
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


</script>

@endsection
