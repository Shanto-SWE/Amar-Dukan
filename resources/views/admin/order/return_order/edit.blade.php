<form action="{{route('return.order.update')}}" method="Post" id="edit_form">
      	@csrf
      <div class="modal-body">
    
          <div class="form-group">
          <input type="hidden" name="return_id" value="{{ $data->id }}">
            <label for="coupon_amount">Change Request Status </label>
            <select class="form-control" name="request_status" >
      		 	    <option value="Pending" @if($data->return_status=="Pending") selected @endif>Pending</option>
						<option value="Approved" @if($data->return_status=="Approved") selected @endif>Approved</option>
						<option value="Rejected" @if($data->return_status=="Rejected") selected @endif>Rejected</option>
					
      		 </select>
          </div>   
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"><span class="loader d-none">..Loading</span> <span class="update">Update</span></button>
      </div>
    </form>

     <script type="text/javascript">
    	$('#edit_form').submit(function(e){
		    e.preventDefault();
		    $('.loader').removeClass('d-none');
            $('.update').addClass('d-none');
		    var url = $(this).attr('action');
        
		    var request =$(this).serialize();
		    $.ajax({
		      url:url,
		      type:'post',
		      async:false,
		      data:request,
		      success:function(data){  
		        toastr.success(data);
		        $('#edit_form')[0].reset();
		        $('#editModal').modal('hide');
		        $('.loader').addClass('d-none');
                $('.update').removeClass('d-none');
                $('.ytable').DataTable().ajax.reload();
		      }
		    });
		  });
    </script>