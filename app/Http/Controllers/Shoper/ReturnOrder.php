<?php

namespace App\Http\Controllers\Shoper;

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
use Session;


class ReturnOrder extends Controller
{
    // show return order
    public function index(Request $request)
    {
       if ($request->ajax()) {
    
        $shop=Session::get('shoper');
        $shop_name=$shop->shop_name;

            $returnOrder="";
            $query=Return_product::orderBy('id','DESC');


          

            if ($request->returnStatus=="Pending") {
                $query->where('return_status',"Pending");
            }
            if ($request->returnStatus=="Approved") {
                $query->where('return_status',"Approved");
            }
            if ($request->returnStatus=="Rejected") {
                $query->where('return_status',"Rejected");
            }



            $returnOrder=$query->where('shop_name',$shop_name)->get();
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
                    ->addColumn('order_id', function($row){
                        if($row->order_id!==Null){
                            $orderDetails='<a href="'.route('shoper.order.view',[$row->order_id]).'" ><i class="fas fa-eye"></i> '.$row->order_id.'</a>
                            ';
                             return $orderDetails;  
                        }else{
                            $orderDetails='<a href="'.route('shoper.request-order.view',[$row->request_id]).'" ><i class="fas fa-eye"></i> '.$row->request_id.'</a>
                            ';
                             return $orderDetails; 
                        }
                      
                    })
                    ->rawColumns(['status','order_id'])
                    ->make(true);       
        }
        return view('shoper.order.return_order.index');
    }

}
