<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Admin;
use Mail; 
use Hash;
use DB; 
use Carbon\Carbon; 
use Illuminate\Support\Str;


class ForgetPassword extends Controller
{
    function forgetPassword(){
        return view('admin.forgetPassword.forgetpasswithemail');
   
       }
        // password forgot link sent
        function resetPasswordLink(Request $request){
            $this->validate($request, [
                'email' => 'required|email',
            ]);
           $admin=Admin::where('email',$request->email)->first();
           if(!$admin){
            return back()->withErrors(['message'=>'We can not find a user that e-mail address']);
           }else{
    
            $token = Str::random(64);
      
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);
    
          $mail=  Mail::send('admin.forgetPassword.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Admin Reset Password');
            });
          
                return redirect()->back()->with('success',' We have e-mailed your password reset link!');
     
       
        }
           
           
        
        
        }
        public function resetPasswordFrom($token) { 
            return view('admin.forgetPassword.resetPassword', ['token' => $token]);
         }

        //  reset password
        function resetPassword(Request $request){
            $request->validate([
                'email' => 'required|email|exists:admins',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);
        $updatePassword = DB::table('password_resets')
            ->where([
              'email' => $request->email, 
              'token' => $request->token,
            ])
            ->first();
    
            if(!$updatePassword){
                return back()->withErrors(['message'=> 'Invalid token!']);
               
            }
    
            $admin =Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    
    DB::table('password_resets')->where(['email'=> $request->email])->delete();
    
    return redirect('/admin/login')->with('success', 'Your password resset has been changed!');  
        }
}
