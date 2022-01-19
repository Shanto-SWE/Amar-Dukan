<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use\App\Models\Coupon;
use\App\Models\AdminNotification;
use\App\Models\ShoperNotification;
use\App\Models\User;
use\App\Models\Admin;
use\App\Models\District;
use\App\Models\Payment_gateway;
use\App\Models\Shipping_cost;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    function Checkout(){
        $content=Cart::content();
        $customer=User::first();

        $district=District::where('status',1)->get();
        return view('frontend.cart.checkout',compact('content','district','customer'));
    }

    // coupon apply

    function CouponApply(Request $request){
   $coupon=$request->coupon;
    $check=DB::table('coupons')->where('coupon_code',$coupon)->first();
  $coupon_type=$check->type;

        if($check){
          if(date('Y-m-d',strtotime(date('Y-m-d')))<= date("Y-m-d",strtotime($check->valid_date))){
            // coupon type fixed
      if($coupon_type=='1'){
        $coupon_type="Tk";
        $subtotal=Cart::subtotalFloat();
     $coupon_amount=$check->coupon_discount;
        $after_couponaply=(int)$subtotal-(int)$coupon_amount;
        $after_discount= number_format($after_couponaply, 2);
          session::put('coupon',[
            'name'=>$check->coupon_code,
            'coupon_type'=>$coupon_type,
            'discount'=>$check->coupon_discount,
            'after_discount'=>$after_discount,
          ]);
          $notification = array(
            'message' => 'Coupon Applied !',
            'alert-type' => 'success'
        );
     
      return redirect()->back()->with($notification);
    //  coupon type Percentage
      }else{
        $coupon_type="%";
        $subtotal=Cart::subtotalFloat();
        $coupon_amount=$check->coupon_discount;
        $after_couponaply=(int)$subtotal-((int)$subtotal*(int)$coupon_amount/100);
      $after_discount= number_format($after_couponaply, 2);
      session::put('coupon',[
        'name'=>$check->coupon_code,
        'coupon_type'=>$coupon_type,
        'discount'=>$check->coupon_discount,
        'after_discount'=>$after_discount,
      ]);
      $notification = array(
        'message' => 'Coupon Applied !',
        'alert-type' => 'success'
    );
 
  return redirect()->back()->with($notification);
      }

          }else{

            $notification = array(
                'message' => 'Expired coupon code !',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
          }
           
         
        }else{

            $notification = array(
                'message' => 'Invalid coupon code ! Try again',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
         }


    }
    // coupon remove

    function CouponRemove(Request $request){
        $request->session()->forget('coupon');
        $notification = array(
            'message' => 'Coupon remove Successfully!',
            'alert-type' => 'success'
        );
     
        return redirect()->back()->with($notification);
    }

    // order place
    function OrderPlace(Request $request){


      $district_name=$request->c_city;
      $district=District::where('district_name',$district_name)->first();
      $district_id=$district->id;
      $shipping=Shipping_cost::where('district_id',$district_id)->first();
      $shipping_cost=$shipping->shipping_cost;

      $user=Session::get('user');
      $userid=$user->id;
   
      $admin=Admin::where('id',1)->first();

      $shop=Session::get('shop');
      $shop_name=$shop->shop_name;
      $shop_id=$shop->id;
  
      if ($request->payment_type=="Hand Cash") {
        $coupon_type=Session::get('coupon')['coupon_type'];
      $order=array();
      $order['customer_id']=$userid;
      $order['shop_name']= $shop_name;
      $order['c_name']= $request->c_name;
      $order['c_phone']=$request->c_phone;
      $order['c_address']=$request->c_address;
      $order['c_area']=$request->c_area;
      $order['c_email']=$request->c_email;
      $order['c_extra_phone']=$request->c_extra_phone;
      $order['c_city']=$request->c_city;
      if(Session::has('coupon')){
          $order['coupon_code']=Session::get('coupon')['name'];
          $order['coupon_discount']=Session::get('coupon')['discount'].$coupon_type;
          $order['after_discount']=number_format((int)Session::get('coupon')['after_discount']+(int)$shipping_cost,2);
      }else{
     
          $order['after_discount']='0.00';
          $order['coupon_discount']='0.00';
          
      }
      $order['total']=number_format((int)Cart::total()+(int)$shipping_cost,2);
      $order['subtotal']=Cart::subtotal();
      $order['shipping_cost']=$shipping_cost;
      $order['payment_type']=$request->payment_type;
      $order['tax']=0;
      $order['order_id']=rand(10000,900000);
      $order['status']=0;
      $order['date']=date('d-m-Y');
      $order['month']=date('F');
      $order['year']=date('Y');
      $order['created_at']=Carbon::now();

      
      $order_id=DB::table('orders')->insertGetId($order);


    //order details
    $content=Cart::content();
    $shop_id=Session::get('shop')['id'];
    $details=array();
    foreach($content as $row){
        $details['order_id']=$order_id;
        $details['product_id']=$row->id;
        $details['shop_id']=$shop_id;
        $details['product_name']=$row->name;
        $details['quantity']=$row->qty;
        $details['weight']=$row->options->product_weight;
        $details['single_price']=$row->price;
        $details['subtotal_price']=$row->price*$row->qty;
        DB::table('orderdetalis')->insert($details);

   
       
    }
   //send notification to admin
   $notification=AdminNotification::create([
    'data'=>'One new order by '.$request->c_email.'-'.$shop_name,
    'url'=>'http://127.0.0.1:8000/admin/order',
    'time'=> Carbon::now(),
]);
   // send notification to shoper
   $notification=ShoperNotification::create([
     'shop_id'=>$shop_id,
    'data'=>'You have one new order by '.$request->c_name,
    'url'=>'http://127.0.0.1:8000/shopkeeper/order',
    'time'=> Carbon::now(),
]);
        // mail send
        // $order_id=[
        //   'order_id'=>$order_id,

        // ];
        // Mail::to($request->c_email)->send(new InvoiceMail($order,$order_id));


    Cart::destroy();
    if (Session::has('coupon')) {
          Session::forget('coupon');
    }
    $shopslug=Session::get('shop')['shop_slug'];

    $notification = array(
      'message' => 'Successfully Order Placed!',
      'alert-type' => 'success'
  );

  return redirect('/user/dashboard')->with($notification); 
           //__aamarpay payment gateway  
      }elseif($request->payment_type=="Aamarpay"){

        $aamarpay=Payment_gateway::first();
        if($aamarpay->store_id==NULL){
          $notification = array(
            'message' => 'lease setting your payment gateway!',
            'alert-type' => 'error'
        );
          return redirect()->back()->with($notification);
     }else{
         if($aamarpay->status==1){
             $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
         }else{
             $url = 'https://sandbox.aamarpay.com/request.php';
         }
         if(Session::has('coupon')){
          $amount=Session::get('coupon')['after_discount'];
       
      }else{
          $amount=Cart::total();
          
      }

         $fields = array(
          'store_id' => $aamarpay->store_id,
          'amount' =>  $amount, 
          'payment_type' => 'VISA', 
          'currency' => 'BDT',  
          'tran_id' => rand(1111111,9999999), 
          'cus_name' => $request->c_name,  
          'cus_email' => $request->c_email, 
          'cus_add1' => $request->c_address,  
          'cus_add2' => 'Mohakhali DOHS', 
          'cus_city' => $request->c_city,  
          'cus_state' => 'Dhaka',  
          'cus_postcode' => '',
          'cus_country' => '',  
          'cus_phone' => $request->c_phone,
          'cus_fax' => $request->c_extra_phone,  
          'ship_name' => $shop_name, 
          'ship_add1' => 'House B-121, Road 21', 
          'ship_add2' => 'Mohakhali',
          'ship_city' => 'Dhaka', 
          'ship_state' => 'Dhaka',
          'ship_postcode' => '1212', 
          'ship_country' => 'Bangladesh',
          'desc' => 'payment description', 
          'success_url' => route('success'), 
          'fail_url' => route('fail'),
          'cancel_url' => route('cancel'), 
          'opt_a' => $request->c_area, 
          'opt_b' => $request->c_city, 
          'opt_c' => $request->c_phone, 
          'opt_d' => $request->c_address,
          'signature_key' => $aamarpay->signature_key); 
          $fields_string = http_build_query($fields);
   
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_VERBOSE, true);
      curl_setopt($ch, CURLOPT_URL, $url);  

      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
      curl_close($ch); 

      $this->redirect_to_merchant($url_forward);


      }
    }


  }
    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php	
        exit;
    } 
  public function success(Request $request){
    $user=Session::get('user');
    $userid=$user->id;

    $shop=Session::get('shop');
    $shop_name=$shop->shop_name;
    $shop_id=$shop->id;
    $coupon_type=Session::get('coupon')['coupon_type'];

    $order=array();
    $order['customer_id']=$userid;
    $order['shop_name']=$shop_name;
    $order['c_name']= $request->cus_name;
    $order['c_phone']=$request->opt_c;
    $order['c_address']=$request->opt_d;
    $order['c_area']=$request->opt_a;
    $order['c_email']=$request->cus_email;
    $order['c_extra_phone']=$request->cus_fax;
    $order['c_city']=$request->opt_b;
    if(Session::has('coupon')){
        $order['subtotal']=Cart::subtotal();
        $order['coupon_code']=Session::get('coupon')['name'];
        $order['coupon_discount']=Session::get('coupon')['discount'].$coupon_type;
        $order['after_discount']=Session::get('coupon')['after_discount'];
    }else{
        $order['subtotal']=Cart::subtotal();
        $order['after_discount']='0.00';
        $order['coupon_discount']='0.00';
        
    }
    $order['total']=Cart::total();
    $order['payment_type']='Aamarpay';
    $order['tax']=0;
    $order['shipping_cost']=0;
    $order['order_id']=rand(10000,900000);
    $order['status']=1;
    $order['date']=date('d-m-Y');
    $order['month']=date('F');
    $order['year']=date('Y');
    $order['created_at']=Carbon::now();

    
    $order_id=DB::table('orders')->insertGetId($order);


  //order details
  $content=Cart::content();
  $shop_name=Session::get('shop')['id'];
  $details=array();
  foreach($content as $row){
      $details['order_id']=$order_id;
      $details['product_id']=$row->id;
      $details['shop_id']=$shop_name;
      $details['product_name']=$row->name;
      $details['quantity']=$row->qty;
      $details['weight']=$row->options->product_weight;
      $details['single_price']=$row->price;
      $details['subtotal_price']=$row->price*$row->qty;
      DB::table('orderdetalis')->insert($details);

 

  }
     //send notification to admin
     $notification=AdminNotification::create([
      'data'=>'One new order by '.$request->cus_email.'-'.$shop_name,
      'url'=>'http://127.0.0.1:8000/admin/order',
      'time'=> Carbon::now(),
  ]);
     // send notification to shoper
     $notification=ShoperNotification::create([
       'shop_id'=>$shop_id,
      'data'=>'You have one new order by '.$request->$request->cus_name,
      'url'=>'http://127.0.0.1:8000/admin/order',
      'time'=> Carbon::now(),
  ]);
      // mail send
      // $order_id=[
      //   'order_id'=>$order_id,

      // ];
      // Mail::to($request->cus_email)->send(new InvoiceMail($order,$order_id));


  Cart::destroy();
  if (Session::has('coupon')) {
        Session::forget('coupon');
  }
  $shopslug=Session::get('shop')['shop_slug'];

  $notification = array(
    'message' => 'Successfully Order Placed!',
    'alert-type' => 'success'
);

return redirect('/user/dashboard')->with($notification); 
  }
  

  public function fail(Request $request){
    return $request;
}


// get shipping cost for district
function GetShippingCost($districtName){

      $district=District::where('district_name',$districtName)->first();
      $district_id=$district->id;
      $shipping=Shipping_cost::where('district_id',$district_id)->first();
      $shipping_cost=$shipping->shipping_cost;
        return response()->json($shipping_cost);
}

}
