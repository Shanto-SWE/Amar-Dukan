@extends('layouts.admin')

@section('title','User')
@section('admin_content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
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
                <h3 class="card-title">Users list here</h3>
              </div>
              <div class="row">
               <div class="col-12">
               <button class="btn btn-primary printReport w-100"> <span class="loader d-none">Loading...</span> <span class="print">Print</span></button>
                 
               </div>
           </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>FullName</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Registration_date</th>
              
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
		  table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('customer.report') }}",
			columns:[
		{data:'DT_RowIndex',name:'DT_RowIndex'},
		{data:'FullName'  ,name:'FullName'},
        {data:'email'  ,name:'email'},
        {data:'phone'  ,name:'phone'},
        {data:'registration_date'  ,name:'registration_date'},

			]
		});
	});


</script>
<script type="text/javascript">
	// print customer reprot

$('.printReport').on('click',function(e){

e.preventDefault();
$('.loader').removeClass('d-none');
$('.print').addClass('d-none');

$.ajax({
	url:"{{route('report.customer.print')}}",
	type:'get',
	success:function(data){
	  $('.loader').addClass('d-none');
	  $('.print').removeClass('d-none');
	  $(data).printThis({
			   debug:false,
			   importCSS:true,
			   importStyle:true,
			   removeInline:false,
			   printDelay:500,
			   header:null,
			   footer:null,

	  });

	}
});


});
</script>
@endsection
