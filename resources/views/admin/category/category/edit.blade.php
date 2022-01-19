<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
 <form action="{{route('category.update')}}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
      <div class="form-group">
      <label for="exampleInputEmail1">shop Name </label>
                      <select class="form-control" name="shop_id">
                        @foreach($shop as $row)
                         <option value="{{ $row->id }}"  @if($row->id==$data->shop_id) selected="" @endif>{{ $row->shop_name }}</option>
                        @endforeach 
                      </select>
          </div> 
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="e_category_name" name="category_name" value="{{ $data->category_name }}" required="">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <small id="emailHelp" class="form-text text-muted">This is your main category</small>
          </div>  
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">Category Logo</label>
            <input type="file"  class="dropify" data-height="140"  name="category_logo">
            <input type="hidden" name="old_logo" value="{{ $data->category_logo }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($data->category_logo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div> 
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">Category thumbnail</label>
            <input type="file"  class="dropify" data-height="140"  name="category_thumbnail">
            <input type="hidden" name="old_thumbnail" value="{{ $data->category_thumbnail }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($data->category_thumbnail) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div> 
          <div class="form-group">
          		  <label for="start-date">Home Page category<span class="text-danger">*</span></label>
          		  <select class="form-control" name="home_page" required>
                  <option value="">Select one</option>
          		  	<option value="1"  @if($data->home_page==1) selected="" @endif>Active</option>
          		  	<option value="0" @if($data->home_page==0) selected="" @endif>Inactive</option>
          		  </select>
                <small id="emailHelp" class="form-text text-muted">This is your home page category </small>
          		</div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">update</button>
      </div>
      </form>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>