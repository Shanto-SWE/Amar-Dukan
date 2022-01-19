<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('shoper.home')}}" class="nav-link">Home</a>
      </li>

      @php
      $shop=Session::get('shoper');
      $shop_slug=$shop->shop_slug;

      @endphp
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('website.home',$shop_slug)}}" class="nav-link btn btn-success">View Your Shop</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block mx-2">
      <a href="{{route('shoper.logout')}}" class="nav-link btn btn-success">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
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


         $shop=Session::get('shoper');
         $shop_id=$shop->id;

          $notification=DB::table('shoper_notifications')->where('shop_id',$shop_id)->orderBy('id','DESC')->limit(8)->get();
          $notifi=DB::table('shoper_notifications')->where('shop_id',$shop_id)->first();

          $count=App\Models\ShoperNotification::where('shop_id',$shop_id)->where('status',1)->count('id');

          @endphp
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell shopernotificationbell"></i>
          <span class="badge badge-warning navbar-badge shopernotificationstatus">{{$count}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
      
      @if($notifi)
       @foreach($notification as $row)
       @if($row->seen==1)
       <a href="{{$row->url}}" class="dropdown-item notificationcolor shoperseen" data-id="{{$row->id}}">
         @else
         <a href="{{$row->url}}" class="dropdown-item  ">
           @endif
        <p><i class="fas fa-envelope mr-2 "></i>{{$row->data}}<samll class="float-right text-muted text-sm">{{Carbon\Carbon::parse($row->time)->diffForHumans()}}</samll></p>
       
       </a>
          @endforeach
          <a href="{{route('shoper.all.notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
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