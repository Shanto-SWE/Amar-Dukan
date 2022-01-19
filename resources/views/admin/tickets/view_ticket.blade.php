@extends('layouts.admin')

@section('title','View-Ticket')
@section('admin_content')
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reply Ticket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ticket Reply</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <div class="content">
    	<div class="container-fluid">
    		<div class="card  p-2">
        	  <div class="row">	
        		<div class="col-md-9">
        			<strong>User: {{  $ticket->FullName }}</strong><br>
        			<strong>Subject: {{  $ticket->subject }}</strong><br>
        			<strong>Service: {{  $ticket->service }}</strong><br>
        			<strong>Priority: {{  $ticket->priority }}</strong><br>
        			<strong>Message: {{  $ticket->message }}</strong>
        		</div>
        		<div class="col-md-3">
        		 <a href="{{ asset($ticket->image) }}" target="_blank"><img src="{{ asset($ticket->image) }}" style="height:80px; width:120px;"></a>
        		</div>
        		</div>
        	</div>
    	</div>
    </div>

 
    <section class="content">
      <div class="container-fluid">
       <form action="{{route('admin.store.reply')}}" method="post" enctype="multipart/form-data">
        @csrf
       	<div class="row">
     
          <div class="col-md-6">
       
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reply Ticket Message</h3>
              </div>
        
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputEmail1">Message<span class="text-danger">*</span> </label>
                      <textarea type="text" class="form-control" name="message" required=""> </textarea>
                      <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Image  </label>
                      <input type="file" class="form-control"  name="image">
                    </div>
                  </div>
                  <div>
                  	<button type="submit" class="btn btn-info">Reply Message</button>
                  </div>
                </div>
             
            </div>
    
            <a href="{{route('admin.close.ticket',$ticket->id)}}" class="btn btn-danger" style="float:right;"> Close Ticket </a>
           </div>
        </form> 

      
          <div class="col-md-6">
          	@php 
          		$replies=DB::table('ticket_replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
          	@endphp

   
            <div class="card card-primary" >
            <div class="card-header">All Replies</div>
              	<div class="card-body" style="height: 450px; overflow-y: scroll;" >

        		@isset($replies)	
        		   @foreach($replies as $row)
        			<div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
					  <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
					   <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ $ticket->FullName }} @endif
					  </div>
					  <div class="card-body">
				
					      <p>{{ $row->message }}</p>
					      <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
					
					  </div>
					</div>
				  @endforeach	
				@endisset	

        	 </div>
           </div>
         </div>
      
      </div>
    </section>
   
  </div>

@endsection