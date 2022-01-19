<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Order;
use\App\Models\OrderDetali;
use\App\Models\Shop;
use\App\Models\User;
use\App\Models\Brand;
use\App\Models\District;
use\App\Models\Categories;
use DataTables;
use DB;
use Session;
use Carbon\Carbon;

class ReportController extends Controller
{
    function OrderReport(Request $request){
        if ($request->ajax()) {
         
    
            $order="";
              $query=Order::orderBy('id','DESC');
    
              if ($request->shop_name) {
                $query->where('shop_name',$request->shop_name);
            }
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }
    
                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
    
                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               
    
            $order=$query->get();
            return DataTables::of($order)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge bg-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge bg-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge bg-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge bg-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge bg-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge bg-danger">Cancel</span>';
                        }
                    })
            
                    ->rawColumns(['status'])
                    ->make(true);       
        }
        $shop=Shop::where('status',1)->get();
        return view('admin.report.order.index',compact('shop'));
       }


    //    print order report
    function OrderReportPrint(Request $request){
        if ($request->ajax()) {
         
    
            $order="";
              $query=DB::table('orders')->orderBy('id','DESC');
    
              if ($request->shop_name) {
                $query->where('shop_name',$request->shop_name);
            }
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }
    
                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
    
                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               
    
            $order=$query->get();
            
        }
      
      
        return view('admin.report.order.print',compact('order'));
       }
    //    customer report
    public function CustomerReport(Request $request)
    {
        if ($request->ajax()) {
            $data=User::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                
                    ->make(true);       
        }

        return view('admin.report.customer.index');
    }
 //    customer report print
 function CustomerReportPrint(Request $request){

    if ($request->ajax()) {
        $user=User::get();
          
    }

    return view('admin.report.customer.print',compact('user'));

 }

    // product report
    public function ProductReport(Request $request)
 {
     if ($request->ajax()) {
        $imgurl='storage/files/products';


         $product="";
         $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
               ->leftJoin('sub_categories','products.subcategory_id','sub_categories.id') 
                 ->leftJoin('shops','products.shop_id','shops.id');

               if ($request->category_id) {
                $query->where('products.category_id',$request->category_id);
             }
             if ($request->shop_id) {
                $query->where('products.shop_id',$request->shop_id);
            }
            if ($request->brand_id) {
                $query->where('products.brand_id',$request->brand_id);
            }
            if ($request->status==1) {
                $query->where('products.status',1);
            }
            if ($request->status==0) {
                $query->where('products.status',0);
            }

                 $product=$query->select('products.*','categories.category_name','sub_categories.Subcategory_name','shops.shop_name')
                    ->get();
         return DataTables::of($product)
                 ->addIndexColumn()
                 ->editColumn('thumbnail',function($row) use ($imgurl){
                     return '<img src="'.$imgurl.'/'.$row->thumbnail.'"  height="30" width="30" >';
                 })
            
            
          
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return ' <span class="badge badge-success">active</span>';
                    }else{
                        return ' <span class="badge badge-danger">deactive</span>';
                    }
                })
              
                 ->rawColumns(['thumbnail','status'])
                 ->make(true);       
     }

   $category=Categories::all();
   $shop=Shop::where('status',1)->get();
   $brand=Brand::all();
     return view('admin.report.product.index',compact('category','shop','brand'));
 }

//  product report print
function ProductReportPrint(Request $request){
    if ($request->ajax()) {



         $product="";
         $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
               ->leftJoin('sub_categories','products.subcategory_id','sub_categories.id') 
                 ->leftJoin('shops','products.shop_id','shops.id');

               if ($request->category_id) {
                $query->where('products.category_id',$request->category_id);
             }
             if ($request->shop_id) {
                $query->where('products.shop_id',$request->shop_id);
            }
            if ($request->brand_id) {
                $query->where('products.brand_id',$request->brand_id);
            }
            if ($request->status==1) {
                $query->where('products.status',1);
            }
            if ($request->status==0) {
                $query->where('products.status',0);
            }

                 $product=$query->select('products.*','categories.category_name','sub_categories.Subcategory_name','shops.shop_name')
                    ->get();
    

        }
     return view('admin.report.product.print',compact('product'));
}
//  shop report
function ShopReport(Request $request){

    if ($request->ajax()) {

        $shop="";
      $query=DB::table('shops')->leftJoin('districts','shops.district_id','districts.id')
      ->select('districts.district_name','shops.*');

      if ($request->district_id) {
        $query->where('district_id',$request->district_id);
    }

    if ($request->status==0) {
        $query->where('shops.status',0);
    }
    if ($request->status==1) {
        $query->where('shops.status',1);
    }

 

    $shop=$query->get();
      return DataTables::of($shop)
              ->addIndexColumn()
              ->editColumn('status',function($row){
                if ($row->status==1) {
                    return ' <span class="badge badge-success">active</span> ';
                }else{
                    return ' <span class="badge badge-danger">deactive</span>';
                }
            })
          
              ->rawColumns(['status'])
              ->make(true);       
  }

    $district=District::where('status',1)->get();
    return view('admin.report.shop.index',compact('district'));
}


// shop report print

function ShopReportPrint(Request $request){

    if ($request->ajax()) {

        $shop="";
      $query=DB::table('shops')->leftJoin('districts','shops.district_id','districts.id')
      ->select('districts.district_name','shops.*');

      if ($request->district_id) {
        $query->where('district_id',$request->district_id);
    }

    if ($request->status==0) {
        $query->where('shops.status',0);
    }
    if ($request->status==1) {
        $query->where('shops.status',1);
    }

 

    $shop=$query->get();
      
  }

    return view('admin.report.shop.print',compact('shop'));
}

// customer report chart
function CustomerReportChart(){

  $current_month_user=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
 $before_1_month=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
 $before_2_month=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
 $before_3_month=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
 $before_4_month=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
 $userCount=array($current_month_user,$before_1_month,$before_2_month,$before_3_month,$before_4_month);


//  calculate months
 $months=array();
$count=0;
while($count<=4){
   $months[]=date("M Y",strtotime("-".$count."month"));
   $count ++;
}
 
    return view('admin.report_chart.customer',compact('userCount','months'));
}
// order report chart
function OrderReportChart(){

    $current_month_order=Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
    $before_1_month=Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
    $before_2_month=Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
    $before_3_month=Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
    $before_4_month=Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
    $orderCount=array($current_month_order,$before_1_month,$before_2_month,$before_3_month,$before_4_month);
//  calculate months
$months=array();
$count=0;
while($count<=4){
   $months[]=date("M Y",strtotime("-".$count."month"));
   $count ++;
}
    return view('admin.report_chart.order',compact('orderCount','months'));
}

// shop report chart
function ShopReportChart(){
    $current_month_shop=Shop::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
 $before_1_month=Shop::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
 $before_2_month=Shop::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
 $before_3_month=Shop::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
 $before_4_month=Shop::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
 $shopCount=array($current_month_shop,$before_1_month,$before_2_month,$before_3_month,$before_4_month);
//  calculate months
 $months=array();
 $count=0;
 while($count<=4){
    $months[]=date("M Y",strtotime("-".$count."month"));
    $count ++;
 }
    return view('admin.report_chart.shop',compact('shopCount','months'));
}
}
