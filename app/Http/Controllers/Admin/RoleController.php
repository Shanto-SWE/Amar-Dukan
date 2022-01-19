<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;

class RoleController extends Controller
{
    function index(){
        $role=Admin::where('role_admin',1)->get();
        return view('admin.role.index',compact('role'));
    }

    function create(){
        return view('admin.role.create');
    }

    // store role
    function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'unique:admins|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'unique:admins|min:11|numeric',
            'password' => [
                'required',
                'string',
                'min:8',           
            ],
         
         
        ]);
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'position'=>$request->position,
            'role_admin'=>'1',
            'district'=>$request->district,
            'shop'=>$request->shop,
            'category'=>$request->category,
            'product'=>$request->product,
            'shipping_cost'=>$request->shipping_cost,
            'ticket'=>$request->ticket,
            'offer'=>$request->offer,
            'order'=>$request->order,
            'pickup_point'=>$request->pickup_point,
            'currency'=>$request->currency,
            'report_chart'=>$request->report_chart,
            'report'=>$request->report,
            'setting'=>$request->setting,
            'review'=>$request->review,
            'contact_message'=>$request->contact_message,
            'role'=>$request->role,
            'subscriber'=>$request->subscriber,
            'customer'=>$request->customer,
            
         );
   
         $role=Admin::create($data);
         $notification=array('message'=>'Role Create successfully!');
         return redirect()->back()->with($notification);
      

    }

    // edit role
    function edit($id){
        $role=Admin::where('id',$id)->first();
        return view('admin.role.edit',compact('role'));


    }
    // update role
    function update(Request $request,$id){
          // validation
          $role=Admin::where('id',$id)->first();
          $this->validate($request, [
             'email' => "required|unique:admins,email,$role->id",
             'phone' => "required|unique:admins,phone,$role->id",
             'password' => [
                 'string',
                 'min:8',           
             ],
         ]); 
         $data=array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'position'=>$request->position,
            'role_admin'=>'1',
            'district'=>$request->district,
            'shop'=>$request->shop,
            'category'=>$request->category,
            'product'=>$request->product,
            'shipping_cost'=>$request->shipping_cost,
            'ticket'=>$request->ticket,
            'offer'=>$request->offer,
            'order'=>$request->order,
            'pickup_point'=>$request->pickup_point,
            'currency'=>$request->currency,
            'report_chart'=>$request->report_chart,
            'report'=>$request->report,
            'setting'=>$request->setting,
            'review'=>$request->review,
            'contact_message'=>$request->contact_message,
            'role'=>$request->role,
            'subscriber'=>$request->subscriber,
            'customer'=>$request->customer,
        );
     
        $role=Admin::find($id);
        $role->update($data);
        $notification=array('message'=>'Role Updated successfully!');
        return redirect()->route('role.index')->with($notification);

    }
    // delete role
    function delete($id){
        $role=Admin::where('id',$id)->delete();
        $notification=array('message'=>'Role delete successfully!');
         return redirect()->back()->with($notification);
    }
}
