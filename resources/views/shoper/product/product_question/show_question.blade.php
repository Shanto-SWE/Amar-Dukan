
 <form action="{{route('product.answer')}}" method="Post" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Question By</label>
            <input type="text" class="form-control" name="customer_name" value="{{ $data->user->FullName }}" required="">
          
          </div>  
          <div class="form-group">
            <label for="category_name">Product Name</label>
            <input type="text" class="form-control" name="product_name" value="{{ $data->product->name }}" required="">
          
          </div>  
      
          <div class="form-group">
             <div class="row">
             <div class="col-8  mt-5">
               <label for="brand-name">Prodcut Thambnail</label>
      
          
              
               <div style="max-width: 100px; max-height: 100px;">
                                                        <img src="{{ asset('storage/files/products/'.$data->product->thumbnail) }}" class="img-fluid" alt="">
                                                    </div>
               </div>
             </div>
           
          </div>
     
          <div class="form-group mt-3">
            <label for="category_name">Question </label>
            <input type="text" class="form-control" name="question" value="{{ $data->question }}" required="">
            <input type="hidden" name="question_id" value="{{ $data->id }}">
          </div>  
   @if($data->status==1)
          <div class="form-group">
            <label for="category_name">Answer </label>
            <input type="text" class="form-control" name="answer" value="{{ $answer->answer }}" required="">
          
          </div> 

          @else
          <div class="form-group">
            <label for="category_name">Answer </label>
            <input type="text" class="form-control" name="answer"  required="">
          
          </div> 
@endif
          @if($data->status==0)
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>


      @endif
      </form>
