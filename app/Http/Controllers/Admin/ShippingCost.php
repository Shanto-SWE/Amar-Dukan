<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use\App\Models\Shipping_cost;
use\App\Models\District;

class ShippingCost extends Controller
{
      
    // show index
    function index(Request $request){
        if ($request->ajax()) {
            $data="";
            $query=Shipping_cost::leftJoin('districts','shipping_costs.district_id','districts.id')
    		->select('districts.district_name','shipping_costs.*');



            if ($request->district_id) {
                $query->where('shipping_costs.district_id',$request->district_id);
            }

            $data=$query->get();


    		return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status',function($row){
              if ($row->status==1) {
                  return ' <span class="badge badge-success">Active</span> ';
              }else{
                  return '<span class="badge badge-danger">Inactive</span>';
              }
          })
    				->addIndexColumn()
    				->addColumn('action', function($row){
    					$actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('shipping_cost.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';
                       return $actionbtn; 	
    				})
    				->rawColumns(['action','status'])
    				->make(true);		
    	}
           $district=District::where('status',1)->get();
    	return view('admin.shipping_cost.index',compact('district'));

     }
    //  store method
    function store(Request $request){

  
            $validated = $request->validate([
                'district_id' => 'required|unique:shipping_costs',
             ]);


                
        $Shipping_cost = Shipping_cost::create([
            'district_id'=>$request->district_id,
            'shipping_cost' => $request->shipping_cost,
            'status'=>1,
            'date'=>date('d-m-Y'),
        
      
        ]);
        $notification=array('message'=>'Create successfully!');
        return redirect()->route('shipping-cost.index')->with($notification);
    }
      //  edit method
      public function edit($id)
      {
          $shipping_cost=Shipping_cost::where('id',$id)->first();
          $district=District::get();
          return view('admin.shipping_cost.edit',compact('shipping_cost','district'));
      }
    //   update method

    function update(Request $request){
        $id=$request->id;
        // validation
        $shipping_cost=Shipping_cost::where('id',$id)->first();
        $this->validate($request, [
           'district_id' => "required|unique:shipping_costs,district_id,$shipping_cost->id",
       ]);
       $data=array(
         'district_id'=>$request->district_id,
         'shipping_cost'=>$request->shipping_cost,
         'status'=>$request->status,
       
    );
    $shipping_cost=Shipping_cost::where('id',$request->id)->update($data);	
    $notification=array('message'=>'Update successfully!');
    return redirect()->route('shipping-cost.index')->with($notification);


    }

    // delete shipping cost
    function delete($id){
        $shipping_cost=Shipping_cost::find($id);
        $shipping_cost->delete();
        $notification=array('message'=>'Deleted successfully!');
        return redirect()->back()->with($notification);
    }
}
