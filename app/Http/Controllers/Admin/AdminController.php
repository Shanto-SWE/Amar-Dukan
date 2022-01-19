<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use\App\Models\User;
use\App\Models\Admin;
use\App\Models\Contact;
use\App\Models\AdminNotification;
use Session;
use DB;
use Cookie;

class AdminController extends Controller
{
    // admin home
function admin(){
    return view('admin.home');
}


//    admin login
function adminLogin(){
    return view('admin.login.login');
}

// admin make login
function makeLogin(Request $request){


   $admin=DB::table('admins')->where(['email'=>$request->email])->first();

         if(!$admin || !Hash::check($request->password,$admin->password))
         {
             return back()->withErrors(['message'=>'invalid email or password']);
         }else{
            if($request->admin_rememberme===null){
                Cookie::queue(cookie::forget('admin_email'));
                Cookie::queue(cookie::forget('admin_password'));
      
            }else{
                Cookie::queue('admin_email',$request->email,time()+60+60+24+100);
                Cookie::queue('admin_password',$request->password,time()+60+60+24+100);

              

            }
             $request->session()->put('admin',$admin);
 
           return redirect('/admin/home');
         }

}

// admin logout
function logout(Request $request){
    $request->session()->forget('user');
 
    return redirect()->route('admin.login')->with('success','Logout Successfully');
}
  //password change page
  public function PasswordChange(){
    return view('admin.profile.password_change');
}

//  admin password update
 function passwordupdate(Request $request){
    $validated = $request->validate([
        'old_password' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',           
        ],
     ]);


    $admindata=Session::get('admin');
    $current_password=$admindata->password;
    $adminid=$admindata->id;

    $oldpass=$request->old_password;
     $new_password=$request->password; 
    $ConfirmPassword=$request->ConfirmPassword;   
     if (Hash::check($oldpass,$current_password)) { 
         if($new_password==$ConfirmPassword){
            $admin=Admin::findorfail($adminid);  
            $admin->password=Hash::make($request->password);
            $admin->save(); 
       
            return redirect()->route('admin.login')->with('success','Password Changed Successfully');
         }else{
            return back()->withErrors(['message'=>'password and confirm_password is not matched']);
         }
        }else{
            return back()->withErrors(['message'=>'Old Password Not Matched']);
        }
     

}
// all notification
function AllNotification(){
    $notification=AdminNotification::orderBy('id','DESC')->get();

    return view('admin.notification.index',compact('notification'));
}
// notification status change
function NotificationStatusChange(){

    $status=AdminNotification::where('status',1)->update(['status'=>0]);
}
// notification status change
function SeenStatusChange($id){

    $status=AdminNotification::where('id',$id)->update(['seen'=>0]);
}
// clear all notification
function ClearAll(){
    DB::table('admin_notifications')->truncate();
    $notification=array('message'=>'Clear successfully!');
    return redirect()->back()->with($notification);

}
// message notification status change
function MessageStatusChange(){

    $status=Contact::where('status',1)->update(['status'=>0]);
}
}
