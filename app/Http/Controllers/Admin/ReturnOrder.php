<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Return_product;
use\App\Models\Orderdetali;
use\App\Models\Product_request;
use\App\Models\Shop;
use\App\Models\User;
use DataTables;
use Illuminate\Support\Str;
use DB;
use Mail;

class ReturnOrder extends Controller
{
    // show return order
    public function index(Request $request)
    {
       if ($request->ajax()) {
    

            $returnOrder="";
            $query=Return_product::orderBy('id','DESC');


            if ($request->shopName) {
                $query->where('shop_name',$request->shopName);
            }

            if ($request->returnStatus=="Pending") {
                $query->where('return_status',"Pending");
            }
            if ($request->returnStatus=="Approved") {
                $query->where('return_status',"Approved");
            }
            if ($request->returnStatus=="Rejected") {
                $query->where('return_status',"Rejected");
            }



            $returnOrder=$query->get();
            return DataTables::of($returnOrder)
            ->addIndexColumn()
            ->editColumn('status',function($row){
              if ($row->return_status=="Pending") {
                  return ' <span class="badge badge-danger">Pending</span> ';
              }elseif($row->return_status=="Approved"){
                return ' <span class="badge badge-success">Approved</span> ';
              }
              else{
                  return '<span class="badge badge-danger">Rejected</span>';
              }
          })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                       ';
                       return $actionbtn;   
                    })
                    ->addIndexColumn()
                    ->addColumn('order_id', function($row){
                        if($row->order_id!==Null){
                            $orderDetails='<a href="'.route('admin.view.order',[$row->order_id]).'" ><i class="fas fa-eye"></i> '.$row->order_id.'</a>
                            ';
                             return $orderDetails;  
                        }else{
                            $orderDetails='<a href="'.route('admin.request-order.view',[$row->request_id]).'" ><i class="fas fa-eye"></i> '.$row->request_id.'</a>
                            ';
                             return $orderDetails; 
                        }
                      
                    })
                    ->rawColumns(['action','status','order_id'])
                    ->make(true);       
        }
        $shop=Shop::where('status',1)->get();
        return view('admin.order.return_order.index',compact('shop'));
    }

      //edit order request status
      public function EditRequestStatus($id)
      {
          $data=Return_product::where('id',$id)->first();
          return view('admin.order.return_order.edit',compact('data'));
      }
    //update status
    public function UpdateStatus(Request $request){


  
        // update return status in return product table
        $data=array(
            'return_status'=>$request->request_status,
         );
         $returnStatus= Return_product::where('id',$request->return_id)->update($data);
         $return_status=Return_product::where('id',$request->return_id)->first();

         if($return_status->order_id!==Null){
 //  update item status in order details table
 $returnDetails=Return_product::where('id',$request->return_id)->first();

 Orderdetali::where('order_id',$returnDetails->order_id)->where('product_id',$returnDetails->product_id)->update(['item_status'=>'Return ' .$request->request_status]);
// get user details
$userDetails=User::where('id',$returnDetails->user_id)->first();

// send return status email
$email=$userDetails->email;
$return_status=$request->request_status;
// $messageData=['userDetails'=>$userDetails,'return_details'=>$returnDetails,'return_status'=>$return_status];
// Mail::send('emails.return_order',$messageData,function($message) use ($email,$return_status){
//     $message->to($email)->subject('Return Request'. $return_status);
// });

         }else{
//  update item status in request order table
$returnDetails=Return_product::where('id',$request->return_id)->first();
          Product_request::where('id',$returnDetails->request_id)->update(['item_status'=>'Return '.$request->request_status]);
// get user details
$userDetails=User::where('id',$returnDetails->user_id)->first();

// send return status email
$email=$userDetails->email;
$return_status=$request->request_status;
// $messageData=['userDetails'=>$userDetails,'return_details'=>$returnDetails,'return_status'=>$return_status];
// Mail::send('emails.return_order',$messageData,function($message) use ($email,$return_status){
//     $message->to($email)->subject('Return Request'. $return_status);
// });
         }

       

    return response()->json('Retrun Request has been ' .$request->request_status);

    }
}
