<?php
 
 $dataPoints = array(
  array("y" => $orderCount[4], "label" => $months[4]),
  array("y" =>  $orderCount[3], "label" => $months[3]),
  array("y" =>  $orderCount[2], "label" => $months[2]),
  array("y" =>  $orderCount[1], "label" => $months[1]),
  array("y" =>  $orderCount[0], "label" => $months[0]),

);
 
?>
@extends('layouts.shoper')
@section('shoper_content')

<div class="content-wrapper">



    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shopkeeper Dashboard</h1>
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
   $shoper=Session::get('shoper');
   $id=$shoper->id;
   $shop_name=$shoper->shop_name;

  $total_category=DB::table('categories')->where('shop_id',$id)->count();
  $total_subcategory=DB::table('sub_categories')->where('shop_id',$id)->count();

  $total_product=DB::table('products')->where('shop_id',$id)->count();
  $active_product=DB::table('products')->where('shop_id',$id)->where('status',1)->count();


  $total_order=DB::table('orders')->where('shop_name',$shop_name)->count();
  $total_pendding_order=DB::table('orders')->where('shop_name',$shop_name)->where('status',0)->count();
  $total_success_order=DB::table('orders')->where('shop_name',$shop_name)->where('status',3)->count();
  $total_review=DB::table('shop_reviews')->where('shop_id',$id)->count();

  

  $order=DB::table('orders')->where('shop_name',$shop_name)->orderBy('id','DESC')->limit(8)->get();
  $view_product=App\Models\Product::where('shop_id',$id)->orderBy('view_product','DESC')->limit(8)->get();

  @endphp

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Category</span>
                <span class="info-box-number">
                  {{$total_category}}
            
                </span>
              </div>
       
            </div>
           
          </div>
       
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Subcategory</span>
                <span class="info-box-number">{{$total_subcategory}}</span>
              </div>
           
            </div>
         
          </div>
        

         
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fab fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Product</span>
                <span class="info-box-number">{{$total_product}}</span>
              </div>
        
            </div>
          
          </div>
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fab fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Active Product</span>
                <span class="info-box-number">{{$active_product}}</span>
              </div>
           
            </div>
        
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Order</span>
                <span class="info-box-number">
                  {{$total_product}}
             
                </span>
              </div>
       
            </div>
           
          </div>
       
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pendding Order</span>
                <span class="info-box-number">{{$active_product}}</span>
              </div>
           
            </div>
         
          </div>
        

         
          <div class="clearfix hidden-md-up"></div>

        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Success Order</span>
                <span class="info-box-number">{{$total_success_order}}</span>
              </div>
           
            </div>
        
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Review</span>
                <span class="info-box-number">
                 {{$total_review}}
          
                </span>
              </div>
       
            </div>
           
          </div>
       
        
        

         
        
        </div>
      

      
   
        <div class="row">
     
          <div class="col-md-8">
     
        
            
          <div class="row">
           
              <!-- order report chart -->

           <div class="col-md-12 latastcustomerdas">
          
             <div class="card">
               <div class="card-header">
                 <h3 class="card-title">Order Report Last 5 Months</h3>

                 <div class="card-tools">
                  
                   <button type="button" class="btn btn-tool" data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-tool" data-card-widget="remove">
                     <i class="fas fa-times"></i>
                   </button>
                 </div>
               </div>
              
               <div class="card-body p-0 pb-2">
        
               <div id="chartContainer" style="height: 370px; width: 100%;"></div>
               </div>
           
            
             </div>
       
           </div>
   
         </div>
         

            <!--  latast order -->
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
            
              <div class="card-body p-0">
                <div class="table-responsive">
        
                  <table class="table m-0">
                    
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Name</th>
                      <th>Phone</th>
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
                      <td>{{$row->c_phone}}</td>
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
                  
                    </tbody>
                  </table>
                  
                </div>
              
              </div>
         
              <div class="card-footer clearfix">
            
                <a href="{{route('shoper.order.index')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
         
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
                  @forelse ($view_product as $row)
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
                    
                    </div>
                  </li>
                  @empty
                         <p class="text-center">No Product Found</p>
                    @endforelse
  
                </ul>
              </div>
          
              <div class="card-footer text-center">
                <a href="{{route('shoper.product.index')}}" class="uppercase">View All Products</a>
              </div>
          
            </div>
         
          </div>
        
        </div>
   
      </div>
    </section>
 
  </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Orders Report"
	},
	axisY: {
		title: "Number of Orders"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
@endsection
