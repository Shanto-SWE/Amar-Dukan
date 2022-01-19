<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use\App\Models\User;
use\App\Models\Shop;
use\App\Models\Order;
use\App\Models\District;
use\App\Models\AdminNotification;
use\App\Models\ShoperNotification;
use Session;
use DB;
use File;
use Image;
use Cookie;
use Carbon\Carbon;


use Illuminate\Support\Str;

class ShoperController extends Controller
{
  
    // shoper home
    function Shoper(){
        $shoper=Session::get('shoper');
        $shop_name=$shoper->shop_name;
        
        $current_month_order=Order::where('shop_name',$shop_name)->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        $before_1_month=Order::where('shop_name',$shop_name)->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $before_2_month=Order::where('shop_name',$shop_name)->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        $before_3_month=Order::where('shop_name',$shop_name)->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        $before_4_month=Order::where('shop_name',$shop_name)->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        $orderCount=array($current_month_order,$before_1_month,$before_2_month,$before_3_month,$before_4_month);
    //  calculate months
    $months=array();
    $count=0;
    while($count<=4){
       $months[]=date("M Y",strtotime("-".$count."month"));
       $count ++;
    }
        
        return view('shoper.home',compact('orderCount','months'));
    }


//    Shoper registration
    function ShoperRegistration(){

        $district=District::where('status',1)->get();

        return view('shoper.login.registration',compact('district'));
    }
    //    Shoper registration
function ShoperMakeRegistration(Request $request){

    $validatedData = $request->validate([
        'shop_name'=>'required|unique:shops|max:55',
        'shop_owner_email' => 'required|unique:shops|regex:/(.+)@(.+)\.(.+)/i',

     
    ]);
    $district=District::where('id',$request->district_id)->first();
    $district_name=$district->district_name;
    
    $slug=Str::slug($request->shop_name, '-');
    $shop = Shop::create([
        'shop_name'=>$request->shop_name,
        'shop_owner_name'=>$request->shop_owner_name,
        'shop_owner_email'=>$request->shop_owner_email,
        'shop_slug' => Str::slug($request->shop_name, '-'),
        'shop_city'=>$request->shop_city,
        'district_id'=>$request->district_id,
        'district_name'=> $district_name,
        'shop_area'=>$request->shop_area,
        'shop_phone'=>$request->shop_phone,
        'shop_another_phone'=>$request->shop_another_phone,
        'open_time'=>$request->open_time,
        'close_time'=>$request->close_time,
        'password'=>Hash::make($request->password),
        'registration_date'=>date('d , F Y'),
        'created_at'=>Carbon::now(),
    ]);
           // working with owner photo
           $photo=$request->owner_photo;
           $photoname=$slug.'.'.$photo->getClientOriginalExtension();
           $photo->move('storage/files/shop_owner_photo/',$photoname);
    
           $shop->shop_owner_photo='storage/files/shop_owner_photo/'.$photoname;  
           $shop->save();
  //  working with shop photo
   $photo=$request->shop_photo;
   $photoname=$slug.'.'.$photo->getClientOriginalExtension();
   $photo->move('storage/files/shop_image/',$photoname);

   $shop->shop_photo='storage/files/shop_image/'.$photoname;  
   $shop->save();

//    send notification to admin
            $notification=AdminNotification::create([
                'data'=>'New shop registration request by-'.$request->shop_owner_email,
                'url'=>'http://127.0.0.1:8000/shop',
                'time'=> Carbon::now(),
            ]);
 
     return redirect()->route('shoper.login')->with('success','Registration successfully! Your will be able to login your account when admin will active your account');

}

//    Shoper login
function ShoperLogin(){
    return view('shoper.login.login');
}
// shoper make login
function makeLogin(Request $request){



    $shoper=DB::table('shops')->where(['shop_owner_email'=>$request->email])->first();
    
        if(!$shoper || !Hash::check($request->password,$shoper->password))
        {
            return back()->withErrors(['message'=>'invalid email or password!']);
        }else{
            if($shoper->status==1){

            if($request->shoper_rememberme===null){
                      Cookie::queue(cookie::forget('shoper_email'));
                      Cookie::queue(cookie::forget('shoper_password'));
               
            }else{
              
              Cookie::queue('shoper_email',$request->email,time()+60+60+24+100);
              Cookie::queue('shoper_password',$request->password,time()+60+60+24+100);
               

            }
            $request->session()->put('shoper',$shoper);

          return redirect('/shopkeeper/home');
        
    }else{
        return back()->withErrors(['message'=>'Account yet not active!']);
    }
 
}   
 
 }
 // shoper logout
function logout(Request $request){
    $request->session()->forget('shoper');
 
    return redirect()->route('shoper.login')->with('success','Logout Successfully');
}
    
    // shoper password change
    function ShoperPasswordChange(){

        return view('shoper.passwordchange');
    }
    //  shoper password update
 function ShoperPasswordUpdate(Request $request){
    $validated = $request->validate([
        'old_password' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',           
        ],
     ]);


    $shoperdata=Session::get('shoper');
    $current_password=$shoperdata->password;
    $shoperid=$shoperdata->id;

    $oldpass=$request->old_password;
     $new_password=$request->password; 
    $ConfirmPassword=$request->ConfirmPassword;   
     if (Hash::check($oldpass,$current_password)) { 
         if($new_password==$ConfirmPassword){
            $shoper=Shop::findorfail($shoperid);  
            $shoper->password=Hash::make($request->password);
            $shoper->save(); 
       
            return redirect()->route('shoper.login')->with('success','Password Changed Successfully');
         }else{
            return back()->withErrors(['message'=>'password and confirm_password is not matched']);
         }
        }else{
            return back()->withErrors(['message'=>'Old Password Not Matched']);
        }
     

}
   // shoper profile
   function ShoperProfile(){
        
    $shoper=Session::get('shoper');
    $shoperid=$shoper->id;
    $district=District::all();
    $shoperdetails=Shop::where('id',$shoperid)->first();
    return view('shoper.profileupdate',compact('shoperdetails','district'));
}
// profile update
function ShoperProfileUpdate(Request $request){
   $id = $request->id;
        // validation
      $shop=Shop::where('id',$id)->first();
    $this->validate($request, [
        'shop_name' => "required|unique:shops,shop_name,$id",
        'shop_owner_email' => "required|unique:shops,shop_owner_email,$id",
        'shop_phone' => "required|unique:shops,shop_phone,$id",
        'shop_another_phone' => "unique:shops,shop_another_phone,$id",
       
    ]);
    $district=District::where('id',$request->district_id)->first();
    $district_name=$district->district_name;

    $data=array(
        'shop_name'=>$request->shop_name,
        'shop_owner_name'=>$request->shop_owner_name,
        'shop_owner_email'=>$request->shop_owner_email,
        'shop_slug' => Str::slug($request->shop_name, '-'),
        'shop_city'=>$request->shop_city,
        'district_id'=>$request->district_id,
        'district_name'=>$district_name,
        'shop_area'=>$request->shop_area,
        'shop_phone'=>$request->shop_phone,
        'shop_another_phone'=>$request->shop_another_phone,
        'open_time'=>$request->open_time,
        'close_time'=>$request->close_time,
      
);
  $slug=Str::slug($request->shop_name, '-');


 if ($request->owner_photo) {
   
    if (File::exists($request->old_owner_photo)) {
           unlink($request->old_owner_photo);
      }
   
    $shopPhoto=$request->owner_photo;
    $photoname=$slug.'.'.$shopPhoto->getClientOriginalExtension();
    $shopPhoto->move('storage/files/shop_owner_photo/',$photoname);
    $data['shop_owner_photo']='storage/files/shop_owner_photo/'.$photoname;
    $shop=Shop::find($id);
    $shop->update($data);
    $request->session()->forget('shoper');
    $request->session()->put('shoper',$shop);
     $request->session()->get('shoper');
    $notification=array('message'=>'Shoper Profile update successfully!');
    return redirect()->route('shoper.profile')->with($notification);
  
  }else{
  
  $data['shop_owner_photo']=$request->old_owner_photo;
  $shop=Shop::find($id);
  $shop->update($data);
  $request->session()->forget('shoper');
  $request->session()->put('shoper',$shop);
   $request->session()->get('shoper');
  $notification=array('message'=>'Shoper Profile update successfully!');
  return redirect()->route('shoper.profile')->with($notification);
  } 
}

// all notification
function ShoperAllNotification(){
    $shop=Session::get('shoper');
    $shop_id=$shop->id;

    $notification=ShoperNotification::where('shop_id',$shop_id)->orderBy('id','DESC')->get();

    return view('shoper.notification.index',compact('notification'));
}
// notification status change
function ShoperNotificationStatusChange(){
    $shop=Session::get('shoper');
    $shop_id=$shop->id;
    $status=ShoperNotification::where('shop_id',$shop_id)->where('status',1)->update(['status'=>0]);
}
// notification status change
function ShoperSeenStatusChange($id){
   
    $status=ShoperNotification::where('id',$id)->update(['seen'=>0]);
}
// clear all notification
function ShoperClearAll(){
    DB::table('shoper_notifications')->truncate();
    $notification=array('message'=>'Clear successfully!');
    return redirect()->back()->with($notification);

}

}
