<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Newsletter;
use\App\Models\Shop;
use DataTables;
use Illuminate\Support\Str;
use File;
use Image;
use DB;

class SubscriberController extends Controller
{
    // show district
    public function index(Request $request)
    {
       if ($request->ajax()) {
    

            $newsletter="";
            $query=Newsletter::latest();

            if ($request->status==0) {
                $query->where('status',0);
            }
            if ($request->status==1) {
                $query->where('status',1);
            }


            $newsletter=$query->get();
            return DataTables::of($newsletter)
            ->addIndexColumn()
            ->editColumn('status',function($row){
                if ($row->status==1) {
                    return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                }else{
                    return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                }
          })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('subscriber.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }
        return view('admin.newsletter_subscriber.index');
    }

      //deactive status
      public function deactiveStatus($id)
      {
          $product=Newsletter::where('id',$id)->update(['status'=>0]);
          return response()->json('Update Successfully');
      }
  
      //active staus
      public function activeStatus($id)
      {
          $product=Newsletter::where('id',$id)->update(['status'=>1]);
          return response()->json('Update Successfully');
      }
       // delete subscriber
    function delete($id){
        Newsletter::where('id',$id)->delete();
        $notification=array('message'=>'Subscriber delete successfully!');
         return redirect()->back()->with($notification);
    }
}
