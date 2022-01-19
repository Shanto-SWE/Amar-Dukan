<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\User;
use Mail; 
use Hash;
use DB; 
use Carbon\Carbon; 
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    function forgetPassword(){
     return view('layouts.user.forgotpasswithemail');

    }
 

    // password forgot link sent
    function resetPasswordLink(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
        ]);
       $user=User::where('email',$request->email)->first();
       if(!$user){
        return back()->withErrors(['message'=>'We can not find a user that e-mail address']);
       }else{

        $token = Str::random(64);
  
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

      $mail=  Mail::send('layouts.user.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
      
            return redirect()->back()->with('success',' We have e-mailed your password reset link!');
 
   
    }
       
       
    
    
    }
    public function resetPasswordForm($token) { 
        return view('layouts.user.resetPassword', ['token' => $token]);
     }
   

     function updatePassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
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

        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

DB::table('password_resets')->where(['email'=> $request->email])->delete();

return redirect('/user/login/email')->with('success', 'Your password resset has been changed!');

     }

   
}
