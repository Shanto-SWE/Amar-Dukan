@php
$shop=Session::get('shoper');

$shoper_name=$shop->shop_owner_name;
$shoper_photo=$shop->shop_owner_photo;

@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('shoper.home')}}" class="brand-link">
    <img class="adminlogo" src="{{ asset($setting->logo) }}" alt="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
   
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset($shoper_photo)}}" class="shoperlogo img-circle elevation-2" alt="shoper Image">
        </div>
        <div class="info">
  
<h5 class="text-white">{{$shoper_name}}</h5>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
          <li class="nav-item ">
            <a href="{{route('shoper.home')}}" class="nav-link active">
            <i class="fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          
          </li>
           <!-- category -->
           <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
            <i class="far fa-copy"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('shoper.category.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shoper.subcategory.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Sub-Category</p>
                </a>
              </li>
            
              
            
            
            </ul>
          </li>
           <!-- produdct -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">

            <i class="fab fa-product-hunt"></i>
              <p>
               Product
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('shoper.product.create')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>New Product</p>
                </a>
              </li>
          
            <li class="nav-item">
                <a href="{{route('shoper.product.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Manage Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shoper.product.question')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Product Question</p>
                </a>
              </li>
             
        
             
          
        </ul>
        </li>
                <!-- produdct -->
                <li class="nav-item menu-open">
            <a href="#" class="nav-link ">

            <i class="fas fa-cart-plus"></i>
              <p>
              Order
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('shoper.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>All Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shopkeeper.return.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Return Request</p>
                </a>
              </li>
          
            <li class="nav-item">
                <a href="{{route('shoper.request-order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Request Order</p>
                </a>
              </li>
             
     
             
          
        </ul>
        </li>
                  <!-- shop review -->
                  <li class="nav-item menu-open">
            <a href="#" class="nav-link ">

            <i class="fas fa-star"></i>
              <p>
               Review
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('shoper.review')}}" class="nav-link">
                <i class="fas fa-store"></i>
                  <p>Shop review</p>
                </a>
              </li>
     
             
     
             
          
        </ul>
        </li>
           <!-- shoper profile -->
           <li class="nav-item menu-open">
            <a href="#" class="nav-link ">

            <i class="fas fa-user-circle"></i>
              <p>
               Profile
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('shoper.profile')}}" class="nav-link">
                <i class="fas fa-user-circle"></i>
                  <p>Update Profile</p>
                </a>
              </li>
          
            <li class="nav-item">
                <a href="{{route('shoper.passwordchange')}}" class="nav-link">
                <i class="fas fa-unlock"></i>
                  <p>Password change</p>
                </a>
              </li>
             
              <li class="nav-item ">
            <a href="{{route('shoper.logout')}}" class="nav-link" id="logout">
            <i class="fas fa-sign-out-alt"></i>
              <p>
              Logout
        
              </p>
            </a>
          
          </li>
             
          
        </ul>
        </li>
      </nav>

    </div>
 
  </aside>