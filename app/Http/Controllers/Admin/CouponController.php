<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use\App\Models\Coupon;

class CouponController extends Controller
{
   
    // show coupon
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Coupon::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('type',function($row){
                        if ($row->type==1) {
                            return '<span class="">Fixed</span> ';
                        }else{
                            return '<span class="">Percentage</span> ';
                        }
                    })
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<span class="badge badge-success">Active</span> ';
                        }else{
                            return '<span class="badge badge-danger">Inactive</span> ';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                        <a href="'.route('coupon.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                  
                    ->rawColumns(['action','type','status'])
                    ->make(true);       
        }

        return view('admin.offer.coupon.index');
    }
  //store coupon 
  public function store(Request $request)
  {
       $data=array(
          'coupon_code' =>$request->coupon_code,
          'type' =>$request->type,
          'coupon_discount' =>$request->coupon_discount,
          'valid_date' =>$request->valid_date,
          'status' =>$request->status,
       );
       $coupon=Coupon::insert($data);
       return response()->json('Coupon Store!');

  }
        //   edit coupon
        public function edit($id)
        {
            $data=Coupon::where('id',$id)->first();
            return view('admin.offer.coupon.edit',compact('data'));
        }
            //update coupon
    public function update(Request $request)
    {
        $data=array(
            'coupon_code' =>$request->coupon_code,
            'type' =>$request->type,
            'coupon_discount' =>$request->coupon_discount,
            'valid_date' =>$request->valid_date,
            'status' =>$request->status,
        );
        $coupon=Coupon::where('id',$request->id)->update($data);
        return response()->json('Coupon Updated!');
    }

     // delete coupon
     public function delete($id)
     {
        $coupon=Coupon::where('id',$id)->delete();
         return response()->json('Coupon deleted!');
     }

}
