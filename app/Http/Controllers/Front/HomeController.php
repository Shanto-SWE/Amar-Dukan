<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Categories;
use\App\Models\SubCategories;
use\App\Models\Product;
use\App\Models\Brand;
use\App\Models\Shop;
use\App\Models\Review;
use\App\Models\District;
use\App\Models\Webreview;
use\App\Models\ShopReview;
use\App\Models\Order;
use\App\Models\Orderdetali;
use\App\Models\Page;
use\App\Models\Newsletter;
use\App\Models\Campaign;
use\App\Models\Contact;
use Session;
use Carbon\Carbon;
use Cart;

class HomeController extends Controller
{
    function home(Request $request,$shop_slug){


        $shop=Shop::where('shop_slug',$shop_slug)->first();
        $shop_id=$shop->id;
        $shop_name=$shop->shop_name;
       
         $request->session()->put('shop',$shop);
      
        $websitereview=Webreview::orderBy('id','DESC')->limit(12)->get();

        $menucategory=Categories::where('shop_id',$shop_id)->take(8)->get();
        $brands=Brand::all();
        $category=Categories::where('shop_id',$shop_id)->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->where('shop_id',$shop_id)->latest()->first();
        $featured=Product::where('status',1)->where('featured',1)->where('shop_id',$shop_id)->orderBy('id','DESC')->limit(16)->get();
        $popular_product=Product::where('status',1)->orderBy('view_product','DESC')->where('shop_id',$shop_id)->limit(16)->get();
        $home_page=Categories::where('home_page',1)->where('shop_id',$shop_id)->orderBy('category_name','ASC')->first();
        $home_page_product=Product::where('category_id',$home_page->id)->where('shop_id',$shop_id)->orderBy('id','DESC')->limit(10)->get();
        $home_page_products=Product::where('category_id',$home_page->id)->where('shop_id',$shop_id)->orderBy('id','DESC')->first();
        $random_product=Product::where('status',1)->inRandomOrder()->where('shop_id',$shop_id)->limit(24)->get();
        $today_deal=Product::where('today_deal',1)->where('shop_id',$shop_id)->orderBy('id','DESC')->limit(6)->get();

        $campaign=Campaign::where('status',1)->where('shop_name',$shop_name)->orderBy('id','DESC')->first();

        return view('frontend.home',compact('category','menucategory','bannerproduct','featured','popular_product','home_page','home_page_product','brands','random_product','today_deal','websitereview','shop_id','shop_name','shop_slug','home_page_products','campaign'));
    }

    function product_detalis(Request $request,$slug){
      
        $district=District::all();
       $brands=Brand::all();
        $product=Product::where('slug',$slug)->first();
       $product_view=Product::where('slug',$slug)->increment('view_product');
        $related_product=Product::where('category_id',$product->category_id)->orderBy('id','DESC')->take(10)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
     

        return view('frontend.product.product_details',compact(['product','related_product','brands','review','district']));
    }
   //product quick view
   public function ProductQuickView(Request $request,$id)

   {
       $product=Product::where('id',$id)->first();
       return view('frontend.product.quick_view',compact('product'));
   }

//    subcategory list show
function SubCategoryListShow(Request $request,$slug){
    $shop=Session::get('shop');
    $shop_id=$shop->id;
    $category_logo=Categories::where('category_slug',$slug)->where('shop_id',$shop_id)->first();
    $category_id=$category_logo->id;
    $allsubcategory=SubCategories::where('category_id',$category_id)->get();



  return view('frontend.subcategory.subcategories_list',compact(['allsubcategory','category_logo']));
}

// category wish product
function categorywishproduct(Request $request,$slug){
    $shop=Session::get('shop');
    $shop_id=$shop->id;
    $subcategory=SubCategories::where('Subcat_slug',$slug)->where('shop_id',$shop_id)->first();
    $subcategory_id=$subcategory->id;
    $categorywishproduct=Product::where('subcategory_id',$subcategory_id)->where('shop_id',$shop_id)->orderBy('id','DESC')->get();

 return view('frontend.product.categorywishproduct',compact(['categorywishproduct','subcategory']));
 }

// brand wise product
function BrandProduct($id){
    $product=Product::where('brand_id',$id)->orderBy('id','DESC')->get();

    $brand=Brand::where('id',$id)->first();

    return view('frontend.product.brandwiseproduct',compact(['product','brand']));

}

// district show
function district(Request $request){
    $request->session()->forget('shop');
    $district=District::where('status',1)->get();
    Cart::destroy();
    return view('frontend.district',compact('district'));
}
// shop show
function shop(Request $request,$slug){
    $district=District::where('district_slug',$slug)->first();
    $district_id=$district->id;
     $time = Carbon::now();
     $currentTime= $time->toTimeString();
    $request->session()->forget('shop');
    Cart::destroy();
    $shops=Shop::where('status',1)->where('district_id',$district_id)->first();
    $shop=Shop::where('status',1)->where('district_id',$district_id)->get();
    $district=district::where('id',$district_id)->first();
    $districtname=$district->district_name;
  $shopreview=ShopReview::all();
    return view('frontend.shop',compact('shop','districtname','shops','shopreview','currentTime'));
}
// page

function Page($slug){

    $page=Page::where('page_slug',$slug)->first();
    return view('frontend.page',compact('page'));
}

// store newsletter

function StoreNewsletter(Request $request){

   

    $email=$request->email;
    $check=Newsletter::where('email',$email)->first();

    if($check){
        return response()->json('Email Aready Exist!');
    }else{
        $data=array(
            'email'=>$request->email,
            'status'=>1,
            'date'=>date('d , F Y'),
            'created_at'=>Carbon::now(),

        );
        $newsletter=Newsletter::insert($data);
        return response()->json('Thanks For Subscribe Us!');
    }

    
}


// order tracking
function OrderTracking(){

    return view('frontend.order_tracking');
}
      //check order
      public function CheckOrder(Request $request)
      {
          $check=Order::where('order_id',$request->order_id)->first();
          if ($check) {
              $order=Order::where('order_id',$request->order_id)->first();
              $order_details=Orderdetali::where('order_id',$order->id)->get();
              return view('frontend.order_details',compact('order','order_details'));
          }else{
            // $notification = array(
            //     'message' => 'Invalid OrderID! Try again.',
            //     'alert-type' => 'error'
            // );
            //   return redirect()->back()->with($notification);
              return redirect()->back()->withErrors([ 'Invalid Order ID! Try again.']); 
          }
      }


//   discunt product show   
function ProductDiscount(){

    $shop_id=Session::get('shop')['id'];
 $product=Product::where('shop_id',$shop_id)->get();
    return view('frontend.product.discount_product',compact('product'));
}

//contact

function Contact(){

    return view('frontend.contact');


}

// store contact
function ContactStore(Request $request){

$data=array(
'name'=>$request->name,
'email'=>$request->email,
'phone'=>$request->phone,
'message'=>$request->message,
'time'=> Carbon::now(),

);

$contact=Contact::insert($data);
$notification = array(
    'message' => 'Message Send Successfully !',
    'alert-type' => 'success'
);
return Redirect()->back()->with($notification); 
}

// search product
function ProductSearch(Request $request){
    $shop_id=Session::get('shop')['id'];
 $name=$request->search_product;
$data=Product::where('name','like','%'.$name.'%')->where('shop_id',$shop_id)->get();
$product_name=Product::where('name','like','%'.$name.'%')->where('shop_id',$shop_id)->first();
   return view('frontend.product.search-product',compact('data','name','product_name'));

}

// district search
function districtSearch(Request $request){

   $district_name=$request->search_district;
   $data=District::where('district_slug',$district_name)->get();
   $single_name=District::where('district_slug',$district_name)->first();
   return view('frontend.search_district',compact('data','single_name','district_name'));


}
// shop search
function shopSearch(Request $request){
    $shopreview=ShopReview::all();
    $time = Carbon::now();
    $currentTime= $time->toTimeString();
    $shop_name=$request->search_shop;
    $data=Shop::where('shop_name','like','%'.$shop_name.'%')->get();
    $single_name=Shop::where('shop_name','like','%'.$shop_name.'%')->first();
    return view('frontend.search_shop',compact('data','shop_name','single_name','currentTime','shopreview'));
}

// campaign product show
function campaignProductShow($title){


    $campaign=Campaign::where('title',$title)->first();
    $campaign_id=$campaign->id;
    $product=Product::where('campaign_id',$campaign_id)->get();
    return view('frontend.campaignProduct.product',compact('product','campaign'));
}
// campaign product details
function campaignProduct_detalis($id){

    
    $district=District::all();
    $brands=Brand::all();
    $product=Product::where('id',$id)->first();
    $product_view=Product::where('id',$id)->increment('view_product');
    $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();

    return view('frontend.campaignProduct.productDetails',compact(['product','brands','review','district']));


}

 }
