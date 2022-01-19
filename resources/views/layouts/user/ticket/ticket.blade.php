@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">

@section('content')
@if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
<div class="container  mt-5">
  @else
  <div class="container dashboard mt-5">
@endif

    <div class="row ">
        <div class="col-md-4">
        @include('layouts.user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   All Tickets <a href="{{ route('new.ticket') }}" class="btn btn-sm btn-danger" style="float:right;">Open Ticket</a>
                </div>

                <div class="card-body">
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">Date</th>
                             <th scope="col">Service</th>
                             <th scope="col">Subject</th>
                             <th scope="col">Status</th>
                             <th scope="col" style="width:100px;">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($ticket as $row)
                           <tr>
                             <th scope="row">{{ date('d F , Y') ,strtotime($row->date)  }}</th>
                             <td>{{ $row->service  }}</td>
                             <td>{{ $row->subject }}</td>
                             <td>
                              @if($row->status==0)
                                 <span class="badge badge-danger bg-danger">Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-success bg-success">Replied</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary bg-primary">Closed</span>
                              @endif          
                            </td>
                            <td>
                            	<a href="{{route('ticket.show',$row->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            	<a href="{{route('ticket.delete',$row->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                           </tr>
                          @endforeach 
                         </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
