<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\Smtp;
use App\Models\Setting;
use App\Models\Payment_gateway;
use Image;
use File;

class SettingController extends Controller
{
   

     //seo page show method
     public function seo()
     {
         $data=Seo::first();
         return view('admin.setting.seo',compact('data'));
     }
       //update seo method
    public function seoUpdate(Request $request,$id)
    {
        $data=array(
            'meta_title'=>$request->meta_title,
            'meta_author'=>$request->meta_author,
            'meta_tag'=>$request->meta_tag,
            'meta_keyword'=>$request->meta_keyword,
            'meta_description'=>$request->meta_description,
            'google_verification'=>$request->google_verification,
            'alexa_verification'=>$request->alexa_verification,
            'google_analytics'=>$request->google_analytics,
            'google_adsense'=>$request->google_adsense,
        );
     
        $seo = Seo::find($id);
        $seo->update($data);
        $notification=array('message'=>'SEO Setting Updated successfully!');
        return redirect()->back()->with($notification);
  
    }
       //smtp setting page
       public function smtp()
       {
        $smtp=Smtp::first();
           return view('admin.setting.smtp',compact('smtp'));
       }
   
       //smtp update
       public function smtpUpdate(Request $request,$id){
        $data=array(
            'mailer'=>$request->mailer,
            'host'=>$request->host,
            'port'=>$request->port,
            'user_name'=>$request->user_name,
            'password'=>$request->password,
          
        );
        $smtp = Smtp::find($id);
        $smtp->update($data);
        $notification=array('message'=>'Smtp Setting Updated successfully!');
        return redirect()->back()->with($notification);     
        
       }

   //website setting
    public function website()
    {
        $setting=Setting::get()->first();
        return view('admin.setting.website_setting',compact('setting'));
    }
//website setting update
public function WebsiteUpdate(Request $request,$id)
{
    $data=array(
    'currency'=>$request->currency,
    'phone_one'=>$request->phone_one,
    'phone_two'=>$request->phone_two,
    'main_email'=>$request->main_email,
    'support_email'=>$request->support_email,
    'address'=>$request->address,
    'facebook'=>$request->facebook,
    'twitter'=>$request->twitter,
    'instagram'=>$request->instagram,
    'linkedin'=>$request->linkedin,
    'youtube'=>$request->youtube,
    );
    if ($request->logo) { 
        if (File::exists($request->old_logo)) {
            unlink($request->old_logo);
        }
        $logo=$request->logo;
          $photoname=time().'.'.$logo->getClientOriginalExtension();
          $logo->move('storage/files/setting/logo/',$photoname);
        $data['logo']='storage/files/setting/logo/'.$photoname;  
    }else{   
        $data['logo']=$request->old_logo;
    }

    if ($request->favicon) {  
        if (File::exists($request->old_favicon)) {
            unlink($request->old_favicon);
       }
          $favicon=$request->favicon;
          $favicon_name=uniqid().'.'.$favicon->getClientOriginalExtension();
          $favicon->move('storage/files/setting/fav-logo/',$favicon_name);
          $data['favicon']='storage/files/setting/fav-logo/'.$favicon_name;  
    }else{   
        $data['favicon']=$request->old_favicon;
    }

    $setting=Setting::where('id',$id)->update($data);
    $notification=array('message'=>'Setting update successfully!');
    return redirect()->back()->with($notification);


}
// payment gateway
public function PaymentGateway()
{
    $aamarpay=Payment_gateway::first();
    $ssl=Payment_gateway::skip(1)->first();
    return view('admin.bdpayment_gateway.edit',compact('aamarpay','ssl'));
}

// amarpay update
public function AamarpayUpdate(Request $request)
{
    $data=array(
        'store_id'=>$request->store_id,
        'signature_key'=>$request->signature_key,
        'status'=>$request->status,
    );


   $payment_gateway=Payment_gateway::where('id',$request->id)->update($data);
   $notification=array('message'=>'Payment Gateway Update Updated!');
   return redirect()->back()->with($notification);

}




}
