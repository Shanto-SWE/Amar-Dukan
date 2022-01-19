
@php
$admin=Session::get('admin');

$admin_name=$admin->name;

@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
    <img class="adminlogo" src="{{ asset($setting->logo) }}" alt="">

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
   
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://simg.nicepng.com/png/small/263-2635963_admin-png.png" class="img-circle elevation-2" alt="admin Image">
        </div>
        <div class="info">
   <h3 class="text-white">{{$admin_name}}</h3>
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
            <a href="{{route('admin.home')}}" class="nav-link active">
            <i class="fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          
          </li>
       


          @if($admin->role_admin==1)

          @if($admin->district==1)
             <!-- District -->
       
              <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
            <i class="fas fa-map-marker-alt"></i>
              <p>
              District
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('district.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop Report</p>
                </a>
              </li>
            
            
             
            
            </ul>
          </li>
          @endif
          @if($admin->shop==1)
          <!-- shop -->
         
              </li>
              <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
            <i class="fas fa-store-alt"></i>
              <p>
                Shop
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('shop.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop</p>
                </a>
              </li>
            
            
             
            
            </ul>
          </li>
              @endif

              @if($admin->category==1)
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
                <a href="{{route('category.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('subcategory.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Sub-Category</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('brand.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Brand</p>
                </a>
              </li>
             
            
            </ul>
          </li>
          @endif
          @if($admin->product==1)
          <!-- product -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-product-hunt"></i>
              <p>
               Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Manage Product</p>
                </a>
              </li>
             
              
            </ul>
            @endif
            @if($admin->shipping_cost==1)
                  <!-- shippijng cost -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-truck"></i>
              <p>
               Shipping Cost
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('shipping-cost.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shipping Cost</p>
                </a>
              </li>
        
             
              
            </ul>
            @endif

            @if($admin->ticket==1)
                   <!-- Ticket -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-tumblr-square"></i>
              <p>
               Ticket
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('ticket.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Ticket</p>
                </a>
              </li>
          
             
              
            </ul>
            @endif

            @if($admin->offer==1)
            <!-- Offer -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-smile-beam"></i>
              <p>
               Offer
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('coupon.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Coupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('campaign.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>E-Campaign</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('campaign.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Campaign Products</p>
                </a>
              </li>
            
             

            </ul>
          </li>

          @endif
          @if($admin->order==1)
          <!-- oders -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-cart-plus"></i>
              <p>
               Order
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
         
              <li class="nav-item">
                <a href="{{route('admin.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>All Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('return.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Return Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.request-order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Request Order</p>
                </a>
              </li>
             

            </ul>
          </li>

          @endif
          @if($admin->pickup_point==1)
         <!-- pickup_point -->
         <li class="nav-item">
            <a href="{{route('pickuppoint.index')}}" class="nav-link">
            <i class="fas fa-truck-pickup"></i> Pickup Point
              
            </a>

          </li>

            @endif

            @if($admin->currency==1)
     
               <!-- currnecy -->
         <li class="nav-item">
            <a href="" class="nav-link">
            <i class="far fa-money-bill-alt"></i>  Currnecy
              
            </a>

          </li>
          @endif
          @if($admin->report==1)
         <!-- Report -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="far fa-file"></i>
              <p>
               Reports Print
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('order.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Order Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customer.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Customer Report</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('product.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Product Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shop.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop Report</p>
                </a>
              </li>
            
            </ul>
          </li>
          @endif

          @if($admin->setting==1)
         <!-- setting -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-cog"></i>
              <p>
               Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('seo.setting')}}" class="nav-link">
                <i class="fas fa-search"></i>
                  <p>SEO Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('website.setting')}}" class="nav-link">
                <i class="fas fa-globe"></i>
                  <p>Website Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('page.index')}}" class="nav-link">
                <i class="fas fa-file"></i>
                  <p>Page Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('smtp.setting')}}" class="nav-link">
                <i class="fas fa-envelope"></i>
                  <p>SMTP Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('payment.gateway')}}" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                  <p>Payment Gateway</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if($admin->review==1)
       <!-- Review -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-star"></i>
              <p>
               Review
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('website.review')}}" class="nav-link">
                <i class="fas fa-globe-africa"></i>
                  <p>Website review</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shop.review')}}" class="nav-link">
                <i class="fas fa-store"></i>
                  <p>Shop review</p>
                </a>
              </li>
           
          
            </ul>
          </li>
       @endif
       @if($admin->contact_message==1)
       <!-- Contact  message -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="far fa-id-badge"></i>
              <p>
               Contact Message
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('contact.message')}}" class="nav-link">
                <i class="fas fa-comment-dots"></i>
                  <p>Message</p>
                </a>
              </li>
         
           
          
            </ul>
          </li>
            @endif

            @if($admin->role==1)

       <!-- Role management -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-user-tag"></i>
              <p>
               Role
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('contact.message')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Create Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('contact.message')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Manage Role</p>
                </a>
              </li>
         
           
          
            </ul>
          </li>


          @endif
              <!-- newsletter subscriber -->

          @if($admin->subscriber==1)

    <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-newspaper"></i>
              <p>
               Newsletter Subscriber
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('subscriber.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Subscriber</p>
                </a>
              </li>
           
            
           
          
            </ul>
          </li>
          @endif
       
          @if($admin->customer==1)
                   <!-- Customer -->
                   <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
                <i class="fas fa-user"></i>
                  <p>Customer</p>
                </a>
              </li>

              @endif
                   @else
    <!-- District -->
         
    <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
            <i class="fas fa-map-marker-alt"></i>
              <p>
              District
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('district.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>District</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('district.shop.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop Report</p>
                </a>
              </li>
            
             
            
            </ul>
          </li>
          <!-- shop -->
          </li>
              <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
            <i class="fas fa-store-alt"></i>
              <p>
                Shop
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('shop.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop</p>
                </a>
              </li>
            
            
             
            
            </ul>
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
                <a href="{{route('category.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('subcategory.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Sub-Category</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('brand.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Brand</p>
                </a>
              </li>
             
            
            </ul>
          </li>
          <!-- product -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-product-hunt"></i>
              <p>
               Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Manage Product</p>
                </a>
              </li>
             
              
            </ul>
                  <!-- shippijng cost -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-truck"></i>
              <p>
               Shipping Cost
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('shipping-cost.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shipping Cost</p>
                </a>
              </li>
        
             
              
            </ul>
                   <!-- Ticket -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-tumblr-square"></i>
              <p>
               Ticket
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('ticket.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Ticket</p>
                </a>
              </li>
          
             
              
            </ul>
            <!-- Offer -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-smile-beam"></i>
              <p>
               Offer
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('coupon.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Coupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('campaign.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>E-Campaign</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('campaign.product')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Campaign Products</p>
                </a>
              </li>

            </ul>
          </li>
                     <!-- oders -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-cart-plus"></i>
              <p>
               Order
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
         
              <li class="nav-item">
                <a href="{{route('admin.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>All Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('return.order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Return Request</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.request-order.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Request Order</p>
                </a>
              </li>
             

            </ul>
          </li>
         <!-- pickup_point -->
         <li class="nav-item">
            <a href="{{route('pickuppoint.index')}}" class="nav-link">
            <i class="fas fa-truck-pickup"></i> Pickup Point
              
            </a>

          </li>


     
               <!-- currnecy -->
         <li class="nav-item">
            <a href="" class="nav-link">
            <i class="far fa-money-bill-alt"></i>  Currnecy
              
            </a>

          </li>
               <!-- Report -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="far fa-file"></i>
              <p>
               Reports Chart
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('customer.report.chart')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Customer Report </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('order.report.chart')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Order Report </p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('shop.report.chart')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop Report </p>
                </a>
              </li>
            
            
            </ul>
          </li>
         <!-- Report -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="far fa-file"></i>
              <p>
               Reports Print
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('order.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Order Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customer.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Customer Report</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{route('product.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Product Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shop.report')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Shop Report</p>
                </a>
              </li>
            
            </ul>
          </li>
         <!-- setting -->
         <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-cog"></i>
              <p>
               Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('seo.setting')}}" class="nav-link">
                <i class="fas fa-search"></i>
                  <p>SEO Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('website.setting')}}" class="nav-link">
                <i class="fas fa-globe"></i>
                  <p>Website Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('page.index')}}" class="nav-link">
                <i class="fas fa-file"></i>
                  <p>Page Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('smtp.setting')}}" class="nav-link">
                <i class="fas fa-envelope"></i>
                  <p>SMTP Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('payment.gateway')}}" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                  <p>Payment Gateway</p>
                </a>
              </li>
            </ul>
          </li>

       <!-- Review -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-star"></i>
              <p>
               Review
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('website.review')}}" class="nav-link">
                <i class="fas fa-globe-africa"></i>
                  <p>Website review</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shop.review')}}" class="nav-link">
                <i class="fas fa-store"></i>
                  <p>Shop review</p>
                </a>
              </li>
           
          
            </ul>
          </li>

       <!-- Contact  message -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="far fa-id-badge"></i>
              <p>
               Contact Message
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('contact.message')}}" class="nav-link">
                <i class="fas fa-comment-dots"></i>
                  <p>Message</p>
                </a>
              </li>
         
           
          
            </ul>
          </li>


       <!-- Role management -->
       <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-user-tag"></i>
              <p>
               Role
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('role.create')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Create Role</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Manage Role</p>
                </a>
              </li>
         
           
          
            </ul>
          </li>
          <!-- newsletter subscriber -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-newspaper"></i>
              <p>
               Newsletter Subscriber
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('subscriber.index')}}" class="nav-link">
                <i class="fas fa-arrow-right"></i>
                  <p>Subscriber</p>
                </a>
              </li>
           
            
           
          
            </ul>
          </li>
                   <!-- Customer -->
                   <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
                <i class="fas fa-user"></i>
                  <p>Customer</p>
                </a>
              </li>

              @endif

         <!-- user profile -->
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
                <a href="{{route('admin.password.change')}}" class="nav-link">
                <i class="fas fa-unlock"></i>
                  <p>Password change</p>
                </a>
              </li>
             
              <li class="nav-item ">
            <a href="{{route('admin.logout')}}" class="nav-link" id="logout">
            <i class="fas fa-sign-out-alt"></i>
              <p>
              Logout
        
              </p>
            </a>
          
          </li>
             
        </ul>
      </nav>

    </div>
 
  </aside>