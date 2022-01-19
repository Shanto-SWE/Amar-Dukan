<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\Coupon;
use DataTables;
use DB;
use App\Exports\userExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=User::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="'.route('user.view',[$row->id]).'" class="btn btn-info btn-sm edit" ><i class="fas fa-eye"></i></a>
                        <a href="'.route('user.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_customer"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }

        return view('admin.user.index');
    }

     // delete user
     public function delete($id)
     {
        $user=User::where('id',$id)->delete();
         return response()->json('Customer deleted!');
     }

    //  user view
    function userView($id){
        $user=User::where('id',$id)->first();
        return view('admin.user.view',compact('user'));


    }

    // user export
    function userExport(){
      return Excel::download(new userExport,'users.xlsx');
    }

}
