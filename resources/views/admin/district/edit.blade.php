

     <form action="{{ route('district.update') }}"  method="Post" id="add-form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
      <div class="form-group">
            <label for="shop_name">District Name</label>
            <input type="text" class="form-control"  name="district_name" value="{{$district->district_name}}" placeholder="District Name" required> 
            <input type="hidden" name="id" value="{{ $district->id }}">
          </div> 
      
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">District Photo</label>
            <input type="file"  class="dropify" data-height="140"  name="district_photo"  >
            <input type="hidden" name="old_photo" value="{{ $district->district_photo }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($district->district_photo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div> 
          <div class="form-group">
            <label for="coupon_amount">Status </label>
            <select class="form-control" name="status" >
      		 	    <option value="0" @if($district->status==0) selected @endif>Inactive</option>
						<option value="1" @if($district->status==1) selected @endif>Active</option>
				
      		 </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Update </span> </button>
      </div>
      </form>
   
  