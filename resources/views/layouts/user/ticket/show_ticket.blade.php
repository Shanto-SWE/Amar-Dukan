@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">

@section('content')
@if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
@endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        @include('layouts.user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
            <h3 class="ml-4">Your Ticket Details</h3>
          <div class="row">
              <div class="col-md-9">
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

                <div class="card-body" style="height: 450px; overflow-y: scroll;">
                    <!-- all reply message -->
            @php 
        	$replies=DB::table('ticket_replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
        	@endphp

                   <strong>All Reply Message</strong><br>
                   <hr>
                   <div>
                   @isset($replies)	
        		   @foreach($replies as $row)
        			<div class="card mt-3 @if($row->user_id==0) ml-4 @endif">
					  <div class="card-header text-white @if($row->user_id==0) bg-info @else bg-danger @endif ">
					   <i class="fa fa-user replyusericon"></i> @if($row->user_id==0) Admin @else {{ Session::get('user')['FullName']}}@endif
					  </div>
					  <div class="card-body">
					    <blockquote class="blockquote mb-0">
					      <p>{{ $row->message }}</p>
					      <footer class="blockquote-footer replyfooter">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
					    </blockquote>
					  </div>
					</div>
				  @endforeach	
				@endisset


                   </div>
                </div>
               <div class="card reply_message mt-3">
               <strong>Reply Message.</strong><br>
                   <div>
                   	  <form action="{{route('ticket.reply')}}" method="post" enctype="multipart/form-data">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message</label>
                   	      <textarea class="form-control" name="message" required=""></textarea>
                           <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
              
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Image</label>
                   	    	<input type="file" class="form-control" name="image" >
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                   	  </form>
                   </div>

               </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
