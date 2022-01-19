<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<form action="{{ route('shoper.subcategory.update') }}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
   
           <div class="form-group">
            <label for="category_name">Category Name</label>
            <select class="form-control" name="category_id" required>
            	@foreach($category as $row)
            	  <option value="{{ $row->id }}" @if($row->id==$data->category_id) selected="" @endif >{{ $row->category_name }}</option>
            	@endforeach
            </select>
            <input type="hidden" name="id" value="{{ $data->id }}">
          </div>
          <div class="form-group">
            <label for="category_name">SubCategory Name</label>
            <input type="text" class="form-control"  name="subcategory_name" value="{{ $data->Subcategory_name }}" required="">
            <small id="emailHelp" class="form-text text-muted">This is your sub category</small>
          </div> 
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">SubCategory Logo</label>
            <input type="file"  class="dropify" data-height="140"  name="subcategory_logo"  >
            <input type="hidden" name="old_logo" value="{{ $data->subcat_logo }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($data->subcat_logo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
      </div>
</form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

 
</script>