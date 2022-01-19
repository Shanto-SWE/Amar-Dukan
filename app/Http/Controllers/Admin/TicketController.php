<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use DataTables;
use Image;

class TicketController extends Controller
{
   //__all tickets
   public function index(Request $request)
   {
       if ($request->ajax()) {
          
  
           $ticket="";
           $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');
                
             if ($request->date) {
                 $query->where('tickets.date',$request->date);
              }

              if ($request->type=='Technical') {
                 $query->where('tickets.service',$request->type);
              }
              if ($request->type=='Payment') {
                 $query->where('tickets.service',$request->type);
              }
              if ($request->type=='Affiliate') {
                 $query->where('tickets.service',$request->type);
              }
              if ($request->type=='Return') {
                 $query->where('tickets.service',$request->type);
              }
              if ($request->type=='Refund') {
                 $query->where('tickets.service',$request->type);
              }

             if ($request->status==1) {
                  $query->where('tickets.status',1);
             }

             if ($request->status==0) {
                 $query->where('tickets.status',0);
             }

             if ($request->status==2) {
                 $query->where('tickets.status',2);
             }

  
             $ticket=$query->select('tickets.*','users.FullName')->get();
             return DataTables::of($ticket)
             ->addIndexColumn()
             ->editColumn('status',function($row){
                 if ($row->status==1) {
                     return '<span class="badge badge-success"> Running </span>';
                 }elseif($row->status==2){
                     return '<span class="badge badge-primary"> Close </span>';
                 }else{
                     return '<span class="badge badge-danger"> Pending </span>';
                 }
             })
             ->editColumn('date',function($row){
                return date('d F Y', strtotime($row->date));
             })
             ->addColumn('action', function($row){
                 $actionbtn='
                 <a href="'.route('admin.ticket.show',[$row->id]).'" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                 <a href="'.route('admin.ticket.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_ticket"><i class="fas fa-trash"></i>
                 </a>';
                return $actionbtn;   
             })
             ->rawColumns(['action','status','date'])
             ->make(true);       
 }
 return view('admin.tickets.index');


}
    //__show method
    public function ShowTicket($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.FullName')->where('tickets.id',$id)->first();
        return view('admin.tickets.view_ticket',compact('ticket'));
    }
//  ticket reply
function ReplyTicket(Request $request){
    $validated = $request->validate([
        'message' => 'required',
     ]);

     $data=array(
    'message'=>$request->message,
    'ticket_id'=>$request->ticket_id,
    'user_id'=>0,
    'reply_date'=>date('Y-m-d'),
);
      if ($request->image) {
           //working with image
               $photo=$request->image;
               $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
               Image::make($photo)->resize(600,350)->save('storage/files/ticket/'.$photoname); 
               $data['image']='storage/files/ticket/'.$photoname; 
      } 
     
     DB::table('ticket_replies')->insert($data);
     DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);
      
     $notification=array('message'=>'Reply Done!');
     return redirect()->back()->with($notification);
}

// ticket close
function CloseTicket($id){
    DB::table('tickets')->where('id',$id)->update(['status'=>2]);
    $notification=array('message'=>'Ticket Closed!');
    return redirect()->route('ticket.index')->with($notification);


}

// ticket distory
 function destroy($id)
{
    $ticket=DB::table('tickets')->find($id);
    $image=$ticket->image;
    if (File::exists($image)) {
        unlink($image);
        DB::table('tickets')->where('id',$id)->delete();
   }
  
    return response()->json('successfully deleted!');
}



}