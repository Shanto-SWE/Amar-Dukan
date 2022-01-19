
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
 <form action="{{ route('shipping_cost.update') }}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
      <div class="form-group">
            <label for="brand-name">District Name</label>
            <select class="form-control" name="district_id">
                        @foreach($district as $row)
                         <option value="{{ $row->id }}"  @if($row->id==$shipping_cost->district_id) selected="" @endif>{{ $row->district_name }}</option>
                        @endforeach 
                      </select>
          </div>
          
          <div class="form-group">
           <label for="brand-name">Shipping Cost</label>
            <input type="text" class="form-control"  name="shipping_cost" value="{{ $shipping_cost->shipping_cost }}" required="">
            <input type="hidden" name="id" value="{{ $shipping_cost->id }}">
          </div>   
          <div class="form-group">
          <label for="coupon_amount">Status </label>
          <select class="form-control" name="status">
                     
                         <option value="1"  @if($shipping_cost->status==1) selected="" @endif>Active</option>
                         <option value="0"  @if($shipping_cost->status==0) selected="" @endif>Inactive</option>
                     
                      </select>
             </div>
           
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