<?php

namespace App\Http\Controllers\Admin;

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
use App\Exports\orderExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
   function index(Request $request){
    if ($request->ajax()) {
     

        $product="";
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
                
                      
                        <a href="'.route('admin.view.invoice',[$row->id]).'" target="_blank" class="btn btn-sm btn-primary orderInvoice" " title="view invoice"><i class="fas fa-print"></i></a>
                        <a href="#" class="btn btn-sm btn-primary orderInvoice"  data-id="'.$row->id.'" title="print invoice"><i class="fas fa-file-pdf"></i></a>';
                       return $print; 
                     }
               
                })
                ->addColumn('action', function($row){
          

                    $actionbtn='
                    <a href="'.route('admin.view.order',[$row->id]).'" class="btn btn-primary btn-sm view" ><i class="fas fa-eye"></i></a>
                    <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a> 
                    <a href="'.route('admin.order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                    </a>';
                   return $actionbtn;   
                })
                ->rawColumns(['action','status','print'])
                ->make(true);       
    }
    $shop=Shop::where('status',1)->get();
    return view('admin.order.index',compact('shop'));
   }

     //order edit
     public function EditOrder($id)
     {
         $order=DB::table('orders')->where('id',$id)->first();
         return view('admin.order.edit',compact('order'));
     }

         //update status
    public function UpdateStatus(Request $request)
    {
        
        $data=array(
       'c_name'=>$request->c_name,
       'c_email'=>$request->c_email,
       'c_address'=>$request->c_address,
       'c_phone'=>$request->c_phone,
       'status'=>$request->status,
    );
        // if($request->status=='1'){
        //     Mail::to($request->c_email)->send(new RecievedOrder($data));
        // }
        if($request->status=='2' || $request->status=='2'){
            $data['shipped_date']=date('d-m-Y');
        }
       $order= Order::where('id',$request->id)->update($data);

    //    order history

         $history=array(
             'order_id'=>$request->id,
             'order_status'=>$request->status,
             'time'=>Carbon::now(),

         );
        $orderHistory=OrderHistory::insert($history);
        return response()->json('successfully changed status!');
    }
    // change status
    function ChangeStatus(Request $request){
        $data=array(
            'status'=>$request->status,
         );
         if($request->status=='3'){
            $data['shipped_date']=date('d-m-Y');

        }
          //    order history

          $history=array(
            'order_id'=>$request->id,
            'order_status'=>$request->status,
            'time'=>Carbon::now(),

        );
        if($request->status=='2'){
            $history['delivery_man_name']=$request->deleverManName;
            $history['delivery_man_phone']=$request->deleverManPhone;

        }
       $orderHistory=OrderHistory::insert($history);

        $order= Order::where('id',$request->id)->update($data);
        $notification=array('message'=>'Order Update Status successfully!');
        return redirect()->back()->with($notification);

    }

    // view order details
    function ViewOrder($id){
      $order=Order::where('id',$id)->first();
        $order_details=OrderDetali::where('order_id',$id)->get();
        $order_history=OrderHistory::where('order_id',$id)->get();
        $single_history=OrderHistory::where('order_id',$id)->where('order_status',2)->first();
        return view('admin.order.order_details',compact('order','order_details','order_history','single_history'));
    }

//    order delete
function OrderDelete($id){
    $order=Order::where('id',$id)->delete();
       $order_details=OrderDetali::where('order_id',$id)->delete();
       $notification=array('message'=>'Order Deleted successfully!');
       return redirect()->back()->with($notification);
     
}
   

// view order invoice
function viewInvoice($id){
    $order=Order::where('id',$id)->first();
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('admin.order.view_invoice',compact('order','order_details'));

}
// order invoice print
function OrderPrint($id){
    $order=Order::where('id',$id)->first();
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('admin.order.invoice_print',compact('order','order_details'));

}

// order export
function orderExport(){
    return Excel::download(new orderExport,'order.xlsx');

}
}
