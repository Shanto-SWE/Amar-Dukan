<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Shop;
use Mail; 
use Hash;
use DB; 
use Carbon\Carbon; 
use Illuminate\Support\Str;
class ForgotPassword extends Controller
{
    function forgetPassword(){
        return view('shoper.forget_password.forgetpasswithemail');
    }
        // password forgot link sent
        function resetPasswordLink(Request $request){
            $this->validate($request, [
                'email' => 'required|email',
            ]);
           $shoper=Shop::where('shop_owner_email',$request->email)->first();
           if(!$shoper){
            return back()->withErrors(['message'=>'We can not find a user that e-mail address']);
           }else{
    
            $token = Str::random(64);
      
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);
    
          $mail=  Mail::send('shoper.forget_password.forgetpass', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Shoper Reset Password');
            });
          
                return redirect()->back()->with('success',' We have e-mailed your password reset link!');
     
       
        }
           
           
        
        
        }
        public function resetPasswordFrom($token) { 
            return view('shoper.forget_password.resetpassword', ['token' => $token]);
         }

        //  update password
        function resetPassword(Request $request){
            $request->validate([
                'email' => 'required',
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
    
            $shoper =Shop::where('shop_owner_email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    
    DB::table('password_resets')->where(['email'=> $request->email])->delete();
    
    return redirect('/shopkeeper/login')->with('success', 'Your password resset has been changed!');  
        }
       
}
