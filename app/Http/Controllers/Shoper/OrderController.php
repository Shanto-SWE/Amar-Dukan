<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Order;
use\App\Models\OrderDetali;
use\App\Models\Shop;
use\App\Models\OrderHistory;
use DataTables;
use Illuminate\Support\Str;
use Image;
use DB;
use File;
use Session;
use Mail;
use App\Mail\RecievedOrder;
use Carbon\Carbon;
class OrderController extends Controller
{
    function index(Request $request){
        if ($request->ajax()) {

                  
        $shop=Session::get('shoper');
        $shop_name=$shop->shop_name;

      
    
            $product="";
              $query=Order::orderBy('id','DESC')->where('shop_name',$shop_name);
    
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
               
    
            $product=$query->get();
            return DataTables::of($product)
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
                    ->addColumn('print', function($row){
          
                        if($row->status==2 || $row->status==3){
                           $print='
                           <a href="'.route('shopkeeper.view.invoice',[$row->id]).'" target="_blank" class="btn btn-sm btn-primary orderInvoice" " title="view invoice"><i class="fas fa-print"></i></a>
                           <a href="#" class="btn btn-sm btn-primary shoperOrderInvoice"  data-id="'.$row->id.'" title="print invoice"><i class="fas fa-file-pdf"></i></a>';
                          return $print; 
                        }
                  
                   })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('shoper.order.view',[$row->id]).'"  class="btn btn-primary btn-sm view"><i class="fas fa-eye"></i></a>
     
                        <a href="'.route('shoper.order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status','print'])
                    ->make(true);       
        }

        return view('shoper.order.index');

    }
      
       // view order details
         function ViewOrder($id){
             $order=Order::where('id',$id)->first();
             $order_details=OrderDetali::where('order_id',$id)->get();
             $order_history=OrderHistory::where('order_id',$id)->get();
             return view('shoper.order.order_details',compact('order','order_details','order_history'));
         }
     
     //    order delete
     function OrderDelete($id){
         $order=Order::where('id',$id)->delete();
            $order_details=OrderDetali::where('order_id',$id)->delete();
            $notification=array('message'=>'Order Deleted successfully!');
            return redirect()->back()->with($notification);
          
     }
// view invoice
function ViewInvoice($id){
    $order=Order::where('id',$id)->first();
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('shoper.order.view_invoice',compact('order','order_details'));

}
   // order invoice print
    function OrderPrint($id){
    $order=Order::where('id',$id)->first();
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('shoper.order.invoice_print',compact('order','order_details'));

}
}
