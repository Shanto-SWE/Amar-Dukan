@extends('layouts.admin')

@section('title','Products')
@section('admin_content')


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Product</h1>
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
                <h3 class="card-title">All Product List </h3>
              </div><br>
              <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Category</label>
              		 <select class="form-control submitable" name="category_id" id="category_id">
              		 	<option value="">All</option>
              		 	  @foreach($category as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
				  
				  <div class="form-group col-3">
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
              		 	<option value="1">All</option>
              		 	    <option value="1">Active</option>
  											<option value="0">Inactive</option>
              		 </select>
              	</div>
              </div>
              <div class="row">
               <div class="col-12">
               <button class="btn btn-primary printReport w-100"> <span class="loader d-none">Loading...</span> <span class="print">Print</span></button>
               </div>
           </div>
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Shop_name</th>
					            <th>quantity</th>
                      <th>stock</th>
                      <th>Unit</th>
                      <th>S_Price(TK)</th>
                      <th>D_Price(TK)</th>
                      <th>Category</th>
                      <th>Subcategory</th>
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
	$(function products(){
		table=$('.ytable').DataTable({
	"processing":true,
      "serverSide":true,
      "searching":true,
      "ajax":{
        "url": "{{ route('product.report') }}", 
        "data":function(e) {
          e.category_id =$("#category_id").val();
          e.status =$("#status").val();
		      e.brand_id =$("#brand_id").val();
          e.shop_id =$("#shop_id").val();
        }
      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'thumbnail'  ,name:'thumbnail'},
				{data:'name'  ,name:'name'},
        {data:'shop_name'  ,name:'shop_name'},
				{data:'quantity'  ,name:'quantity'},
        {data:'stock_quantity'  ,name:'stock_quantity'},
        {data:'unit'  ,name:'unit'},
        {data:'selling_price'  ,name:'selling_price'},
        {data:'discount_price'  ,name:'discount_price'},
				{data:'category_name',name:'category_name'},
				{data:'Subcategory_name',name:'subcategory_name'},
		    {data:'status',name:'status'},
			
			]
		});
	});

	 

 
 //submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });



	// print product report

$('.printReport').on('click',function(e){

e.preventDefault();
$('.loader').removeClass('d-none');
$('.print').addClass('d-none');

$.ajax({
	url:"{{route('report.product.print')}}",
	type:'get',
	data:{status:$('#status').val(),category_id:$('#category_id').val(),brand_id:$('#brand_id').val(),shop_id:$('#shop_id').val()},
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