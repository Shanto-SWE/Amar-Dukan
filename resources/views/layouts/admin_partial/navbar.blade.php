<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link btn btn-success">Website view</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block mx-2">
        <a href="{{route('admin.logout')}}" class="nav-link btn btn-success">Logout</a>
      </li>
    </ul>

    <!-- search bar -->
    <ul class="navbar-nav ml-auto">
   
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      @php
          $notification=DB::table('admin_notifications')->orderBy('id','DESC')->limit(8)->get();
          $notifi=DB::table('admin_notifications')->first();
          $count=App\Models\AdminNotification::where('status',1)->count('id');

          $message=DB::table('contacts')->orderBy('id','DESC')->limit(8)->get();
          $single_message=DB::table('contacts')->first();
          $count_message=App\Models\Contact::where('status',1)->count('id');
          $admin=Session::get('admin');
          @endphp
 <!-- Messages Dropdown Menu -->
 <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments messagelogo"></i>
          <span class="badge badge-danger navbar-badge messagecount">{{$count_message}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
        
            <div class="media">
              <div class="media-body">
              @if($single_message)
              @foreach($message as $row)
                <h3 class="dropdown-item-title mt-1">
                <i class="fas fa-comment-alt"></i> {{$row->name}}
           
                </h3>
                <p class="text-sm">{{ substr($row->message,0,50) }}..</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{Carbon\Carbon::parse($row->time)->diffForHumans()}}</p>
                <div class="dropdown-divider"></div>
                @endforeach
                
              </div>
            </div>
          
          </a>
          <div class="dropdown-divider"></div>
          @if($admin->role_admin==1)
          @if($admin->contact_message==1)
          <a href="{{route('contact.message')}}" class="dropdown-item dropdown-footer">See All Messages</a>
          @endif
          @else
          <a href="{{route('contact.message')}}" class="dropdown-item dropdown-footer">See All Messages</a>
          @endif

        @else
        <a href="#" class="dropdown-item dropdown-footer">No Message Found</a>

        </div>
        @endif
      </li>
       <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell notificatioinbell"></i>
          <span class="badge badge-warning navbar-badge notificationstatus">{{$count}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    
       
          <div class="dropdown-divider"></div>
      
         @if($notifi)
          @foreach($notification as $row)
          @if($row->seen==1)
          <a href="{{$row->url}}" class="dropdown-item notificationcolor seen" data-id="{{$row->id}}">
            @else
            <a href="{{$row->url}}" class="dropdown-item  ">
              @endif
           <p><i class="fas fa-envelope mr-2 "></i>{{$row->data}}<samll class="float-right text-muted text-sm">{{Carbon\Carbon::parse($row->time)->diffForHumans()}}</samll></p>
          
          </a>
             @endforeach
             <a href="{{route('admin.all.notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
         @else
          <a href="#" class="dropdown-item dropdown-footer">No Notifications Found</a>

          @endif
        
        </div>
      
       
      </li>
   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
 
 