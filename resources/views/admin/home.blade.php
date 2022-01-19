@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">

@php
$admin=Session::get('admin');

$position=$admin->position;

@endphp


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$position}} Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  @php
  $total_district=DB::table('districts')->count();
  $active_district=DB::table('districts')->where('status',1)->count();
  $total_shop=DB::table('shops')->count();
  $active_shop=DB::table('shops')->where('status',1)->count();
  $total_product=DB::table('products')->count();
  $active_product=DB::table('products')->where('status',1)->count();

  $total_customer=DB::table('users')->count();
  $total_order=DB::table('orders')->count();
  $total_pendding_order=DB::table('orders')->where('status',0)->count();

  $total_review=DB::table('webreviews')->count();
  $total_pendding_ticket=DB::table('tickets')->where('status',1)->count();
  $total_active_coupon=DB::table('coupons')->where('status',1)->count();



  $latast_customer=DB::table('users')->orderBy('id','DESC')->limit(8)->get();
  $order=DB::table('orders')->orderBy('id','DESC')->limit(8)->get();
  $view_product=App\Models\Product::orderBy('view_product','DESC')->limit(8)->get();

  @endphp

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe-europe"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total District</span>
                <span class="info-box-number">
                  {{$total_district}}
            
                </span>
              </div>
       
            </div>
           
          </div>
       
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-globe-europe"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Active District</span>
                <span class="info-box-number"> {{$active_district}}</span>
              </div>
           
            </div>
         
          </div>
        

         
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-store-alt"></i></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Shop</span>
                <span class="info-box-number">{{$total_shop}}</span>
              </div>
        
            </div>
          
          </div>
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-store-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Active Shop</span>
                <span class="info-box-number">{{$active_shop}}</span>
              </div>
           
            </div>
        
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fab fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Product</span>
                <span class="info-box-number">
                  {{$total_product}}
             
                </span>
              </div>
       
            </div>
           
          </div>
       
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Active Product</span>
                <span class="info-box-number">{{$active_product}}</span>
              </div>
           
            </div>
         
          </div>
        

         
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Register Customer</span>
                <span class="info-box-number">{{$total_customer}}</span>
              </div>
        
            </div>
          
          </div>
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Order</span>
                <span class="info-box-number">{{$total_order}}</span>
              </div>
           
            </div>
        
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pendding Order</span>
                <span class="info-box-number">
                 {{$total_pendding_order}}
          
                </span>
              </div>
       
            </div>
           
          </div>
       
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Review</span>
                <span class="info-box-number">{{$total_review}}</span>
              </div>
           
            </div>
         
          </div>
        

         
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-ticket-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendding Ticket</span>
                <span class="info-box-number">{{$total_pendding_ticket}}</span>
              </div>
        
            </div>
          
          </div>
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tags"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Active Coupon</span>
                <span class="info-box-number">{{ $total_active_coupon}}</span>
              </div>
           
            </div>
        
          </div>
        </div>
      

      
   
        <div class="row">
     
          <div class="col-md-8">
     
        
            <div class="row">
           
              

              <div class="col-md-12 latastcustomerdas">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Customer</h3>

                    <div class="card-tools">
                     
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                 
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                  @foreach($latast_customer as $row)
                      <li>
                        @if($row->photo)
                        <img src="{{asset($row->photo)}}" class="dashboarduser" alt="User Image">
                        @else
                        <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" class="dashboarduser" alt="User Image">
                        @endif
                        <a class="users-list-name" href="#">{{$row->FullName}}</a>
                    
                        <span class="users-list-date">{{$row->registration_date}}</span>
                      </li>
                      @endforeach
                    </ul>
               
                  </div>
               @if($admin->role_admin==1)
                  @if($admin->customer==1)    
                  <div class="card-footer text-center">
                    <a href="{{route('user.index')}}">View All Users</a>
                  </div>
                  @endif
               @else

                  <div class="card-footer text-center">
                    <a href="{{route('user.index')}}">View All Users</a>
                  </div>

                  @endif
               
                </div>
          
              </div>
      
            </div>
         

            <!--  LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                  @if(!empty($order))
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Name</th>
                      <th>Shop Name</th>
                      <th>Payment Type</th>
                      <th>Total</th>
                      <th>Order Date</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                
                      @forelse ($order as $row)
                      
                    <tr>
                      <td><a href="#">{{$row->order_id}}</a></td>
                      <td>{{$row->c_name}}</td>
                      <td>{{$row->shop_name}}</td>
                      <td>{{$row->payment_type}}</td>
                      @if($row->coupon_code!==Null)
                      <td>{{$row->after_discount}}{{$setting->currency}}</td>
                      @else
                      <td>{{$row->total}}{{$setting->currency}}</td>
                      @endif
                      <td>{{date('d , F Y', strtotime($row->date))}}</td>
                      <td>
                        @if($row->status==0)
                        <span class="badge badge-danger">Pendding</span>

                        @elseif($row->status==1)
                        <span class="badge badge-primary">Recieved</span>
                        @elseif($row->status==2)
                        <span class="badge badge-success">Shipped</span>
                        @elseif($row->status==3)
                        <span class="badge badge-success">Completed</span>
                        @elseif($row->status==4)
                        <span class="badge badge-info">Return</span>
                        @else
                        <span class="badge badge-danger">Cancel</span>

                        @endif
                    </td>
                   
                    </tr>
                    @empty
                          <p class="text-center">No Order Found</p>
                  @endforelse
                    @else
                   <tr>
                   <p class="text-center">No Order Found</p>
                   </tr>
                  @endif
                    </tbody>
                  </table>
                </div>
              
              </div>
              @if($admin->role_admin==1)
                  @if($admin->customer==1) 
         
              <div class="card-footer clearfix">
            
                <a href="{{route('admin.order.index')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              @endif

              @else
              <div class="card-footer clearfix">
            
            <a href="{{route('admin.order.index')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
          </div>
          @endif
         
            </div>
          
          </div>
       

          <div class="col-md-4">
      
        

            <!-- MOST VIEW PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Most View Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
    
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach($view_product as $row)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" alt="Product Image" class="img-size-50">
                    </div>
                   
                    <div class="product-info">

                      <small style="  font-weight: bold;">{{$row->view_product}} time view</small><br>
                      <a href="javascript:void(0)" class="product-title">{{$row->name}}
                        @if($row->discount_price!==Null)
                        <span class="badge badge-warning float-right">{{$row->discount_price}}{{$setting->currency}}</span></a>
                        @else
                        <span class="badge badge-warning float-right">{{$row->selling_price}}{{$setting->currency}}</span></a>
                        @endif
                      <span class="product-description">
                    Shop-{{$row->shop->shop_name}}
                      </span>
                    </div>
                  </li>
                  @endforeach
  
                </ul>
              </div>
              @if($admin->role_admin==1)
                  @if($admin->customer==1) 
              <div class="card-footer text-center">
                <a href="{{route('product.index')}}" class="uppercase">View All Products</a>
              </div>
              @endif
              @else
              <div class="card-footer text-center">
                <a href="{{route('product.index')}}" class="uppercase">View All Products</a>
              </div>
              @endif
          
            </div>
         
          </div>
        
        </div>
   
      </div>
    </section>
 
  </div>
@endsection
