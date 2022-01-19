<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Order;
use\App\Models\OrderDetali;
use\App\Models\Product_request;
use\App\Models\OrderHistory;
use\App\Models\Shop;
use DataTables;
use Illuminate\Support\Str;
use Image;
use DB;
use File;
use Session;
use Mail;
use App\Mail\RecievedOrder;
use Carbon\Carbon;
class RequestOrder extends Controller
{
    function index(Request $request){
        if ($request->ajax()) {
      
    
            $product="";
              $query=DB::table('product_requests')->orderBy('id','DESC');
                if ($request->shop_id) {
                    $query->where('shop_id',$request->shop_id);
                }
    
                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }
                if ($request->delivery_date) {
                    $delivery_date=date('d-m-Y',strtotime($request->delivery_date));
                    $query->where('delivery_date',$delivery_date);
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
           
               
    
            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge bg-danger">Pedding</span>';
                        }
                        elseif ($row->status==1) {
                            return '<span class="badge bg-info">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge bg-primary">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge bg-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge bg-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge bg-danger">Cancel</span>';
                        }
                    })
                    ->addColumn('print', function($row){
          
                        if($row->status==1 || $row->status==2||$row->status==3){
                           $print='
                           <a href="'.route('admin.view.request-order.invoice',[$row->id]).'" target="_blank" class="btn btn-sm btn-primary orderInvoice" " title="view invoice"><i class="fas fa-print"></i></a>
                           <a href="#" class="btn btn-sm btn-primary requestOrderInvoice"  data-id="'.$row->id.'" title="print invoice"><i class="fas fa-file-pdf"></i></a>';
                          return $print; 
                        }
                  
                   })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('admin.request-order.view',[$row->id]).'"  class="btn btn-primary btn-sm view" ><i class="fas fa-eye"></i></a>
                        <a href="'.route('admin.request-order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status','print'])
                    ->make(true);       
        }
        $shop=Shop::where('status',1)->get();
    
        return view('admin.request-order.index',compact('shop'));
       }



        // change status
        function ChangeStatus(Request $request){
           $subtotal=$request->price;
            $shipping_cost=$request->shipping_cost;
            $total=(int)$subtotal+(int)$shipping_cost;
        
            $data=array(
                'status'=>$request->status,
                'subtotal_price'=>$request->price,
                'total_price'=>  $total,
                'shipping_cost'=>$request->shipping_cost,
             );
        
                  // order history
                  $history=array(
                      'request_id'=>$request->id,
                      'order_status'=>$request->status,
                      'time'=>Carbon::now(),
          
                  );
                  if($request->status=='2'){
                    $history['delivery_man_name']=$request->deleverManName;
                    $history['delivery_man_phone']=$request->deleverManPhone;
        
                }
                 $orderHistory=OrderHistory::insert($history);
          
    
            $request_order= Product_request::where('id',$request->id)->update($data);
            $notification=array('message'=>'Order Status Update  successfully!');
            return redirect()->back()->with($notification);
        }
    // view order details
       function ViewOrder($id){
        $requestOrder=Product_request::where('id',$id)->first();
        $order_history=OrderHistory::where('request_id',$id)->get();
     $single_history=OrderHistory::where('request_id',$id)->where('order_status',2)->orderBy('id',"DESC")->first();
        return view('admin.request-order.order_details',compact('requestOrder','order_history','single_history'));
    }
//  request  order delete
function OrderDelete($id){
    $requestOrder=Product_request::where('id',$id)->delete();
       $notification=array('message'=>'RequestOrder Deleted successfully!');
       return redirect()->back()->with($notification);
     
}
// view invoice
function viewInvoice($id){
    $request_order=Product_request::where('id',$id)->first();
 

    return view('admin.request-order.view_invoice',compact('request_order'));

}
// request order invoice print
function OrderPrint($id){
    $request_order=Product_request::where('id',$id)->first();
 

    return view('admin.request-order.invoice_print',compact('request_order'));

}
}
