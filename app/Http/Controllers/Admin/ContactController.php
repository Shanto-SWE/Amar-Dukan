<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Contact;
use DataTables;





class ContactController extends Controller
{
     
    // show all contact message
    public function index(Request $request)
    {
       if ($request->ajax()) {
    

            $message=Contact::all();
            return DataTables::of($message)
    
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('contact.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }
        return view('admin.contact-message.index');
    }

    // message delete
    function Delete($id){
        $contact=Contact::find($id);
        $contact->delete();
        $notification=array('message'=>'Message Deleted successfully!');
        return redirect()->back()->with($notification);

    }
}
