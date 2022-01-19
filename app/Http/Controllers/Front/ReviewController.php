<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Review;
use\App\Models\Webreview;
use\App\Models\ShopReview;
use Session;

class ReviewController extends Controller

{
    // review store method for product

    function store(Request $request){

        $validated = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $user=Session::get('user');
        $userid=$user->id;

        $shop=Session::get('shop');
        $shop_id=$shop->id;
      

             $data=array(

                'user_id'=>$userid,
                'shop_id'=>$shop_id,
                'product_id'=>$request->product_id,
                'review'=>$request->review,
                'rating'=>$request->rating,
                'review_date'=>date('d , F Y'),
                'review_month'=>date('F'),
                'review_year'=>date('Y'),
             );
        
            $review=Review::insert($data);
            return response()->json('Thank for your review ');
    }


    // review method for website
    function write(){

        return view('layouts.user.review_write');
    }
    // review store method for website
    function WebReviewStore(Request $request){


        $user=Session::get('user');
        $userid=$user->id;
     

        $data=array(
            'user_id'=> $userid,
            'name'=>$request->name,
            'review'=>$request->review,
            'rating'=>$request->rating,
            'review_date'=>date('d , F Y'),
         
        );
     $Webreviews=Webreview::insert($data);
    
        $notification = array(
            'message' => 'Thanks You For You Review!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 


    }

    // review for shop
    function shopReview(){
        return view('layouts.user.shop_review');

    }
  // review store method for shop
    function ShopReviewStore(Request $request){

        $user=Session::get('user');
        $userid=$user->id;

        $shop=Session::get('shop');
        $shopid=$shop->id;
     

        $data=array(
            'user_id'=> $userid,
            'shop_id'=> $shopid,
            'name'=>$request->name,
            'review'=>$request->review,
            'rating'=>$request->rating,
            'review_date'=>date('d , F Y'),
         
        );
     $ShopReview=ShopReview::insert($data);
    
        $notification = array(
            'message' => 'Thanks You For You Review!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 


    }
}
