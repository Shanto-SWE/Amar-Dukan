@php

$user=Session::get('user');
$user_photo=$user->photo;

@endphp

<div class="card">
    <div class="card-header">Welcome ,{{Session::get('user')['FullName']}}</div>
    <div class="card-body usersidebar">
         <img class="card-img-top userImg" src="{{asset(Session::get('user')['photo'])}}">
         <ul class="list-group list-group-flush">
            <a href="{{ route('user.dashboard') }}" class="text-muted"> <li class="list-group-item"><i class="fas fa-home"></i> Dashboard</li></a>
            @if(Session()->has('shop'))
            <a href="{{route('wishlist.show')}}" class="text-muted"> <li class="list-group-item"><i class="far fa-heart"></i> WishList</li></a>
            @endif
            <a href="{{route('my.order')}}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Order</li></a>
            <a href="{{route('request.order')}}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Request Order</li></a>
            <a href="{{ route('open.ticket') }}" class="text-muted"> <li class="list-group-item"> <i class="fab fa-telegram-plane"></i> Open Ticket</li> </a>
            <a href="{{route('user.profile')}}" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i> Update Profile</li> </a>
            <a href="{{route('user.passwordchange')}}" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i> Change Password</li> </a>
          
            <a href="{{ route('user.logout') }}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-sign-out-alt"></i> Logout</li> </a>
           </ul>
     
    </div>
</div>