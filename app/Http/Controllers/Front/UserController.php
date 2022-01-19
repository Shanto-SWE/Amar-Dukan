<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\Order;
use\App\Models\Orderdetali;
use\App\Models\Product_request;
use\App\Models\AdminNotification;
use\App\Models\ShoperNotification;
use\App\Models\District;
use\App\Models\Question;
use\App\Models\OrderHistory;
use\App\Models\Return_product;
use\App\Models\Product;
use\App\Models\Shop;
use Hash;
use Session;
use File;
use Image;
use Cart;
use URL;
use Redirect;
use DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\RquestOrder;
class UserController extends Controller
{
 // login with email page
 function loginwithemail(){
 
    return view('frontend.login.loginwithemail');

}
 // login with phone page
 function loginwithphone(){
  
    return view('frontend.login.loginwithphone');

}

// user makelogin with email

function makeloginwithemail(Request $request){
   
  $shopslug=Session::get('shop')['shop_slug'];
        $user= User::where(['email'=>$request->email])->first();
        if(!$user || !Hash::check($request->password,$user->password))
                  {
                      return back()->withErrors(['message'=>'invalid email or password']);
                  }else{
                      $request->session()->put('user',$user);
                      $notification = array(
                        'message' => 'Login Successfully !',
                        'alert-type' => 'success'
                    );
                    if($request->remember_me===null){
                      
                        setcookie('email',$request->email,100);
                        setcookie('password',$request->password,100);
                    }else{
                      
                        setcookie('email',$request->email,time()+60+60+24+100);
                        setcookie('password',$request->password,time()+60+60+24+100);

                    }
                     if(Session::has('shop')){
                        return redirect('/home-'.$shopslug)->with($notification); ;
                     }else{
                        $notification = array(
                            'message' => 'Login Successfully !',
                            'alert-type' => 'success'
                        );
                        return Redirect()->route('district.show')->with($notification); 
                     }
                  }


}
// user makelogin withphone

function makeloginwithphone(Request $request){


    $shopslug=Session::get('shop')['shop_slug'];
    $user= User::where(['phone'=>$request->phone_number])->first();
    if(!$user || !Hash::check($request->password,$user->password))
              {
                  return back()->withErrors(['message'=>'invalid email or password']);
              }else{
                  $request->session()->put('user',$user);
                  $notification = array(
                    'message' => 'Login Successfully !',
                    'alert-type' => 'success'
                );
                if($request->remember_me_phone==null){
                    setcookie('phone',$request->phone_number,100);
                    setcookie('phone_password',$request->password,100);
                }else{
                    setcookie('phone',$request->phone_number,time()+60+60+24+100);
                    setcookie('phone_password',$request->password,time()+60+60+24+100);

                }
                if(Session::has('shop')){
                    return redirect('/home-'.$shopslug)->with($notification); 
                 }else{
                    $notification = array(
                        'message' => 'Login Successfully !',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('district.show')->with($notification); 
                 }
           
              }


}
    // register with email
    function registerwithemail(){
        return view('frontend.login.registerwithemail');

    }
 
    // user make registration
    function user_registration(Request $request){

        $validatedData = $request->validate([
            'email' => 'unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'unique:users|min:11|numeric',
            'password' => [
                'required',
                'string',
                'min:8',           
            ],
         
         
        ]);

        $data = array(
            'FullName' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'registration_date'=>date('d , F Y'),
            'created_at'=>Carbon::now(),
            
         );
   
         $user = User::create($data);
         //    send notification to admin
         $notification=AdminNotification::create([
            'data'=>'New user registration by-'. $request->email,
            'url'=>'http://127.0.0.1:8000/admin/user',
            'time'=> Carbon::now(),
        ]);

            return redirect()->route('user.loginwithemail')->with('success',' Registration Successfully,Please login');

        
         
    }
    // user logout
    function user_logout(Request $req){

        $req->session()->forget('user');
        
        $req->session()->forget('coupon');
        $notification = array(
            'message' => 'User Logut Successfully!',
            'alert-type' => 'success'
        );
        Cart::destroy();
        return redirect()->route('user.loginwithemail')->with('success','Logout Successfully');

    }

    // user dashboard

    function UserDashboard(){
      
        $user_id=Session::get('user')['id'];
    if( $user_id){
        $orders=DB::table('orders')->where('customer_id',$user_id)->orderBy('id','DESC')->take(10)->get();
        //total order
        $total_order=DB::table('orders')->where('customer_id',$user_id)->count();
        $complete_order=DB::table('orders')->where('customer_id',$user_id)->where('status',3)->count();
        $cancel_order=DB::table('orders')->where('customer_id',$user_id)->where('status',5)->count();
        $return_order=DB::table('orders')->where('customer_id',$user_id)->where('status',4)->count();
return view('userdashboard',compact('orders','total_order','complete_order','return_order','cancel_order'));
}else{
    return readdird()->back();
}
    }
       

    // user password change
    function UserPasswordChange(){

        return view('layouts.user.passwordchange');
    }

    // user password update
    function UserPasswordUpdate(Request $request){

        $validated = $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',           
            ],
         ]);
    
    
        $userdata=Session::get('user');
        $current_password=$userdata->password;
        $userid=$userdata->id;
    
        $oldpass=$request->old_password;
         $new_password=$request->password; 
        $ConfirmPassword=$request->ConfirmPassword;   
         if (Hash::check($oldpass,$current_password)) { 
             if($new_password==$ConfirmPassword){
                $user=User::findorfail($userid);  
                $user->password=Hash::make($request->password);
                $user->save(); 
           
                return redirect()->route('user.loginwithemail')->with('success','Password Changed Successfully');
             }else{
                return back()->withErrors(['message'=>'password and confirm_password is not matched']);
             }
            }else{
                return back()->withErrors(['message'=>'Old Password Not Matched']);
            }
    }

    // user profile
    function UserProfile(){
        
        $user=Session::get('user');
        $userid=$user->id;

        $userdetails=User::where('id',$userid)->first();
        return view('layouts.user.profileupdate',compact('userdetails'));
    }
    // user profile update

    function UserProfileUpdate(Request $request){

        $user=Session::get('user');
        $id=$user->id;
        $user=User::where('id',$id)->first();
        
     

        $validatedData = $request->validate([
            'email' =>  "unique:users,email,$user->id",
            'phone' =>  "unique:users,phone,$user->id",
     
      
         
        ]);

        $data = array(
            'FullName' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
           'delivery_zone'=>$request->delivery_zone,
           'delivery_area'=>$request->delivery_area,
           'delivery_address'=>$request->delivery_address,
           'occupation'=>$request->occupation,
           'gender'=>$request->gender,

         );
         if ($request->photo) {
            if (File::exists($request->old_photo)) {
                   unlink($request->old_photo);
              }
            $photo=$request->photo;
            $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo->move('storage/files/user_photo/',$photoname);
            $data['photo']='storage/files/user_photo/'.$photoname;	
            $user = User::find($id);
            $user->update($data);
            $request->session()->forget('user');
            $request->session()->put('user',$user);
             $request->session()->get('user');
    
             $notification = array(
                'message' => 'Profile Update Successfully!',
                'alert-type' => 'success'
            );
             return redirect()->route('user.profile')->with($notification);
        }else{
        $data['photo']=$request->old_photo;	
        $user = User::find($id);
        $user->update($data);
        $request->session()->forget('user');
        $request->session()->put('user',$user);
         $request->session()->get('user');

         $notification = array(
            'message' => 'Profile Update Successfully!',
            'alert-type' => 'success'
        );
         return redirect()->route('user.profile')->with($notification);
        }


    }
    function mailformat(){
        return view('frontend.mail.invoice');
    }

    // product request
    function ProductRequest(){
        $district=District::where('status',1)->get();

        return view('layouts.user.product_request',compact('district'));
    }
    // product request store
    function ProductRequestStore(Request $request){
        if(Session::has('user')){
            $user=Session::get('user');
            $userid=$user->id;
        }
     
        $shopId=Session::get('shop')['id'];
        $shop_name=Session::get('shop')['shop_name'];


        $data=array(
           'shop_id'=>$shopId,
           'product_name'=>$request->product_name,
           'product_origin'=>$request->product_origin,
           'product_weight'=>$request->product_weight,
           'product_quantity'=>$request->product_quantity,
           'product_description'=>$request->product_description,
           'name'=>$request->name,
           'email'=>$request->email,
           'phone'=>$request->phone,
           'city'=>$request->city,
           'delivery_area'=>$request->delivery_area,
           'delivery_address'=>$request->delivery_address,
           'delivery_date'=>$request->delivery_date,
           'request_id'=>rand(10000,900000),
           'date'=>date('d-m-Y'),
           'month'=>date('F'),
           'year'=>date('Y'),


        );
       if(Session::has('user')){
           $data['customer_id']= $userid;
       }
      // working with product photo
      $photo=$request->product_photo;
      $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
      $photo->move('storage/files/request_product/',$photoname);

      $data['product_photo']='storage/files/request_product/'.$photoname;  
      DB::table('product_requests')->insert($data);
      
    //   mail send
    // Mail::to($request->email)->send(new RquestOrder($data));
    //send notification to admin
    $notification=AdminNotification::create([
        'data'=>'One new request order by '.$request->email.'-'.$shop_name,
        'url'=>'http://127.0.0.1:8000/admin/request-order',
        'time'=> Carbon::now(),
    ]);
       // send notification to shoper
       $notification=ShoperNotification::create([
         'shop_id'=>$shopId,
        'data'=>'You have one new request order by '.$request->name,
        'url'=>'http://127.0.0.1:8000/shoper/request-order',
        'time'=> Carbon::now(),
    ]);
      $notification = array(
        'message' => 'Product Request Successfully!',
        'alert-type' => 'success'
    );
     return redirect()->back()->with($notification);
    }

    // my order
    function MyOrder(){
        $user=Session::get('user');
        $id=$user->id;
        $orders=DB::table('orders')->where('customer_id',$id)->orderBy('id','DESC')->get();
        return view('layouts.user.myorder',compact('orders'));
    }

    // my requested order
    function RequestOrder(){
        $user=Session::get('user');
        $id=$user->id;
        $requested_orders=Product_request::where('customer_id',$id)->orderBy('id','DESC')->get();
        return view('layouts.user.requested_order',compact('requested_orders'));

    }

    // ticket system
    function ticket(){
        $user=Session::get('user');
        $id=$user->id;
        $ticket=DB::table('tickets')->where('user_id',$id)->latest()->take(10)->get();
        return view('layouts.user.ticket.ticket',compact('ticket'));
    }
    function NewTicket(){

        return view('layouts.user.ticket.new_ticket');
    }
    // store ticket
    public function StoreTicket(Request $request)
    {
        $user=Session::get('user');
        $id=$user->id;
        $validated = $request->validate([
           'subject' => 'required',
        ]);

        $data=array(
      'subject'=>$request->subject,
       'service'=>$request->service,
       'priority'=>$request->priority,
       'message'=>$request->message,
       'user_id'=>$id,
       'status'=>0,
       'date'=>date('Y-m-d'),
    );

         
              //working with image
              if($request->image){
              $photo=$request->image;
              $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
              $photo->move('storage/files/ticket/',$photoname);  
      
              $data['image']='storage/files/ticket/'.$photoname;  
               }
         
        
        DB::table('tickets')->insert($data);
        $notification = array(
            'message' => 'Ticket Inserted!',
            'alert-type' => 'success'
        );
         return redirect()->route('open.ticket')->with($notification);
      
    }
    // ticket show
   function TicketShow($id){
     $ticket=DB::table('tickets')->where('id',$id)->first();
       return view('layouts.user.ticket.show_ticket',compact('ticket'));


   }
//    ticket reply
function TicketReply(Request $request){
    $user=Session::get('user');
    $id=$user->id;
    $validated = $request->validate([
        'message' => 'required',
     ]);

     $data=array(
    'message'=>$request->message,
    'ticket_id'=>$request->ticket_id,
    'user_id'=>$id,
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

     $notification = array(
        'message' => 'Replied Done!',
        'alert-type' => 'success'
    );
     return redirect()->back()->with($notification);

}
// ticket delete
function TicketDelete($id){
    
  $ticket=DB::table('tickets')->find($id);
    $image=$ticket->image;
    if (File::exists($image)) {
        unlink($image);
        DB::table('tickets')->where('id',$id)->delete();
   }
  
    $notification = array(
        'message' => 'Ticket Delete Successfully!',
        'alert-type' => 'success'
    );
     return redirect()->back()->with($notification);

}

// order details
function ViewOrder($id){

    $order=Order::findorfail($id);
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('layouts.user.order_details',compact('order','order_details'));

}
// order cancel

function MyOrderCancel($orderid,Request $request){
  
        $user=Session::get('user');
        $id=$user->id;
    
        $order=Order::where('order_id',$orderid)->first();
        $userId=$order->customer_id;
        $this->validate($request, [
            'reason' => "required",
        
        ]);;
      
        if($id==$userId){
            $data=array(
                'status'=>'5',
                'cancel_date'=>date('d-m-Y'),
         
            );
         $order->update($data);
         
               //    order history
         
               $history=array(
                 'order_id'=>$order->id,
                 'order_status'=>'6',
                 'reason'=>$request->reason,
                 'updated_by'=>'User',
                 'time'=>Carbon::now(),
         
             );
            $orderHistory=OrderHistory::insert($history);
            $notification = array(
             'message' => 'Order Cancel Successfully!',
             'alert-type' => 'success'
         );
          return redirect()->back()->with($notification);
        }else{
            return redirect()->route('my.order')->withErrors([ 'Your Order Cancellation Request Is Not Valid!']);
        }
        
   
    

}
//request order cancel

function MyRequestOrderCancel($id,Request $request){

    $user=Session::get('user');
    $user_id=$user->id;

    $order=Product_request::where('id',$id)->first();
    $userId=$order->customer_id;

    $this->validate($request, [
        'reason' => "required",
    
    ]);

    if($user_id==$userId){
   $data=array(
       'status'=>'5',
       

   );
$order->update($data);

      //    order history

      $history=array(
        'request_id'=>$order->id,
        'order_status'=>'6',
        'reason'=>$request->reason,
        'updated_by'=>'User',
        'time'=>Carbon::now(),

    );
   $orderHistory=OrderHistory::insert($history);
   $notification = array(
    'message' => 'Order Cancel Successfully!',
    'alert-type' => 'success'
);
 return redirect()->back()->with($notification);
}else{
    return redirect()->route('request.order')->withErrors([ 'Your Order Cancellation Request Is Not Valid!']);
}

}

// user return order
function MyOrderReturn($orderid,Request $request){
    $user=Session::get('user');
    $user_id=$user->id;

    $order=Order::where('order_id',$orderid)->first();
    $userId=$order->customer_id;
    $id=$order->id;

    // find product name and shop name
    $product=Product::where('id',$request->product_id)->first();
    $shop_id=$product->shop_id;
    $shop=Shop::where('id',$shop_id)->first();
    $shop_name=$shop->shop_name;
    $shop_id=$shop->id;
    $product_name=$product->name;

    $this->validate($request, [
        'product_id' => "required",
        'returnReason'=>"required",
    
    ]);
    if($user_id==$userId){
        // update item status
        Orderdetali::where('order_id',$id)->where('product_id',$request->product_id)->update(['item_status'=>'Return Initiated']);


        // Add return product
        $data=array(
         'order_id'=>$id,
         'user_id'=>$user_id,
         'user_name'=>$user->FullName,
         'product_id'=>$request->product_id,
         'product_name'=> $product_name,
         'shop_name'=>$shop_name,
         'return_reason'=>$request->returnReason,
         'return_status'=>'Pending',
         'comment'=>$request->comment,
         'date'=>date('d-m-Y'),
         'created_at'=>Carbon::now(),
        );
        $returnProduct=Return_product::insert($data);

            
        //send notification to admin
         $notification=AdminNotification::create([
        'data'=>'One new return product request  by '.$user->FullName.'-'.$shop_name,
        'url'=>'http://127.0.0.1:8000/return_order',
        'time'=> Carbon::now(),
    ]);
       // send notification to shoper
       $notification=ShoperNotification::create([
         'shop_id'=>$shop_id,
        'data'=>'You have one new return product request by '.$user->FullName,
        'url'=>'http://127.0.0.1:8000/return_order',
        'time'=> Carbon::now(),
    ]);
        return redirect()->back()->with('success','Return Request has been placed for the Ordered Product!');

    }else{
        return redirect()->route('my.order')->withErrors([ 'Your Order Return Request Is Not Valid!']);
    }

}

// user return request order product
function MyRequestOrderReturn($id,Request $request){
    $user=Session::get('user');
    $user_id=$user->id;


  $requestorder=Product_request::where('id',$id)->first();
 $shop_id=$requestorder->shop_id;
  $shop=Shop::where('id',$shop_id)->first();
  $shop_name=$shop->shop_name;
 $customer_id=$requestorder->customer_id;
 if($user_id==$customer_id){
            // update item status in product request table
            Product_request::where('id',$id)->update(['item_status'=>'Return Initiated']);

            
        // Add return product to request product tabel 
        $data=array(
            'request_id'=>$id,
            'product_name'=> $requestorder->product_name,
            'user_id'=>$user_id,
            'user_name'=>$user->FullName,
            'shop_name'=>$shop_name,
            'return_reason'=>$request->returnReason,
            'return_status'=>'Pending',
            'comment'=>$request->comment,
            'date'=>date('d-m-Y'),
            'created_at'=>Carbon::now(),
           );
           $returnProduct=Return_product::insert($data);
   //send notification to admin
   $notification=AdminNotification::create([
    'data'=>'One new return product request  by '.$user->FullName.'-'.$shop_name,
    'url'=>'http://127.0.0.1:8000/return_order',
    'time'=> Carbon::now(),
]);
   // send notification to shoper
   $notification=ShoperNotification::create([
     'shop_id'=>$shop_id,
    'data'=>'You have one new return product request by '.$user->FullName,
    'url'=>'http://127.0.0.1:8000/return_order',
    'time'=> Carbon::now(),
]);

 return redirect()->back()->with('success','Return Request has been placed for the Ordered Product!');
 }else{
    return redirect()->route('request.order')->withErrors([ 'Your Order Return Request Is Not Valid!']); 
 }

}


// view request order

function ViewRequestOrder($id){
    $requestorder=Product_request::findorfail($id);
    $order_details=Product_request::where('id',$id)->get();
    return view('layouts.user.myrequest_order',compact('requestorder','order_details'));
}

// user product ask question
function StoreQuestion(Request $request){
    $user=Session::get('user');
    $user_id=$user->id;

    $shop=Session::get('shop');
    $shop_id=$shop->id;

    $validated = $request->validate([
       'question' => 'required',
    ]);

    $data=array(
   'user_id'=>$user_id,
   'product_id'=>$request->product_id,
   'shop_id'=>$shop_id,
   'question'=>$request->question,
   'question_date'=>date('d , F Y'),
);
$queston=Question::insert($data);
$notification = array(
    'message' => 'Question Submitted Seccessfully!',
    'alert-type' => 'success'
);
 return redirect()->back()->with($notification);

 
}
// order invoice 
function OrderPrint($id){
    $order=Order::where('id',$id)->first();
    $order_details=Orderdetali::where('order_id',$id)->get();

    return view('layouts.user.invoice.order_print',compact('order','order_details'));

}
// request order invoice print
function RequestOrderPrint($id){
    $request_order=Product_request::where('id',$id)->first();
 
  return view('layouts.user.invoice.requestOrder_print',compact('request_order'));

}

}
