@extends('layouts.admin')

@section('title','Shop')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shop</h1>
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
                <h3 class="card-title">All Shop list here</h3>
              </div>
          <div class="row">
          <div class="form-group col-3" style="padding-left:25px;">
           <label>District</label>
              		 <select class="form-control submitable" name="district_id" id="district_id">
              		 	<option value="">All</option>
              		 	  @foreach($district as $row)
              		 	    <option value="{{$row->id }}">{{ $row->district_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
                <div class="form-group col-3" style="padding-left:20px;">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="6">All</option>
              		 	    <option value="0">Inactive</option>
  						         	<option value="1">Active</option>
  				
              		 </select>
              	</div>
          </div>
          <div class="row">
               <div class="col-12">
               <button class="btn btn-primary printReport w-100"> <span class="loader d-none">Loading...</span> <span class="print">Print</span></button>
               </div>
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
                      <th>Owner_Photo</th>
                      <th>Owner_Name</th>
                       <th>Shop_Name</th>
                       <th>District</th>
                      <th>city</th>
                      <th>Area</th>
                      <th>Phone</th>
                      <th>Registration_date</th>
                      <th>Status</th>
                 
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
	$(function shop(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
      "ajax":{
		        "url": "{{ route('shop.report') }}", 
		        "data":function(e) { 
              e.district_id =$("#district_id").val();
              e.status =$("#status").val();
         
		        }
		      },
			columns:[
		    {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'shop_owner_photo',name:'shop_owner_photo', render: function(data, type ,full,meta){
					return "<img src=\"" +data+ "\"  height=\"50\" width=\"50\" />";
				}},
        {data:'shop_owner_name'  ,name:'shop_owner_name'},
        {data:'shop_name'  ,name:'shop_name'},
		    {data:'district_name',name:'district_name'},
        {data:'shop_city',name:'shop_city'},
        {data:'shop_area',name:'shop_area'},
		    {data:'shop_phone',name:'shop_phone'},
        {data:'registration_date',name:'registration_date'},
        {data:'status',name:'status'},
	

			]
		});
	});
  	//submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });





	// print shop report

  $('.printReport').on('click',function(e){

e.preventDefault();
$('.loader').removeClass('d-none');
$('.print').addClass('d-none');

$.ajax({
	url:"{{route('report.shop.print')}}",
	type:'get',
	data:{status:$('#status').val(),district_id:$('#district_id').val()},
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