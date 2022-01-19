

     <form action="{{ route('shop.update') }}"  method="Post" id="add-form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
      <div class="form-group">
            <label for="shop_name">Shop Name</label>
            <input type="text" class="form-control"  name="shop_name" value="{{$shop->shop_name}}" placeholder="shop Name" required> 
            <input type="hidden" name="id" value="{{ $shop->id }}">
          </div> 
        
          <div class="form-group">
            <label for="shop_owner_name">Owner Name</label>
            <input type="text" class="form-control"  name="shop_owner_name" value="{{$shop->shop_owner_name}}" placeholder="owner name" required> 
      
          </div> 
          <div class="form-group">
            <label for="shop_name">Owner Email</label>
            <input type="text" class="form-control"  name="shop_owner_email"  value="{{$shop->shop_owner_email}}"  placeholder="Owner Email" required> 
          </div> 
          
          <div class="form-group">
            <label for="shop_district">shop district</label>
            <select class="form-control" name="district_id" required>
                      <option value="" >Select district</option>
                        @foreach($district as $row)
                          <option value="{{ $row->id }}" @if($row->id==$shop->district_id) selected="" @endif>{{ $row->district_name  }}</option>
                        @endforeach
                      </select>
          </div> 
          <div class="form-group">
            <label for="city">Shop city</label>
            <input type="text" class="form-control"  name="shop_city" value="{{$shop->shop_city}}"  placeholder="shop city" required>
          </div>   

          <div class="form-group">
            <label for="shop_area">Shop area</label>
            <input type="text" class="form-control"  name="shop_area" value="{{$shop->shop_area}}" placeholder="shop area" required>
          </div>   

          <div class="form-group">
            <label for="shop_phone">Shop Phone</label>
            <input type="text" class="form-control"  name="shop_phone" value="{{$shop->shop_phone}}" placeholder="shop Phone" required>
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Shop another Phone</label>
            <input type="text" class="form-control"  name="shop_another_phone" value="{{$shop->shop_another_phone}}" placeholder="shop another phone">
          </div>
          <div class="form-group">
            <label for="shop_another_phone">Open Time</label>
            <input type="time" class="form-control" value="{{$shop->open_time}}" name="open_time"  placeholder="open time">
     
          </div> 
          <div class="form-group">
            <label for="shop_another_phone">Close Time</label>
            <input type="time" class="form-control" value="{{$shop->close_time}}"  name="close_time"  placeholder="close time">
          </div> 
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">Owner Photo</label>
            <input type="file"  class="dropify" data-height="140"  name="owner_photo"  >
            <input type="hidden" name="old_photo" value="{{ $shop->shop_owner_photo }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($shop->shop_owner_photo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div>
          
          <div class="form-group">
             <div class="row">
               <div class="col-8">
               <label for="brand-name">Shop Photo</label>
            <input type="file"  class="dropify" data-height="140"  name="shop_photo"  >
            <input type="hidden" name="old_shop_photo" value="{{ $shop->shop_Photo }}">
               </div>
               <div class="col-4 d-flex justify-content-center text-center mt-5">
               <div style="max-width: 150px; max-height: 150px;overflow:hidden; margin-left: auto">
                                                        <img src="{{ asset($shop->shop_photo) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Update </span> </button>
      </div>
      </form>
   
  