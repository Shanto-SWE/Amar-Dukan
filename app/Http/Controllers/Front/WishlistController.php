<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Wishlist;
use Session;


class WishlistController extends Controller
{
     //wishlist
     public function AddWishlist($id)
     {

    
            $userid=Session::get('user')['id'];
            $shop_id=Session::get('shop')['id'];
            $check=Wishlist::where('product_id',$id)->where('user_id',$userid)->first();
            if ($check) {
                $notification = array(
                    'message' => 'Already have it on your wishlist !',
                    'alert-type' => 'error'
                );
         
                  return redirect()->back()->with($notification);
            }else{
                 $data=array(
                    'product_id'=>$id,
                    'user_id'=>$userid,
                    'shop_id'=>$shop_id,
                    'date'=>date('d-m-Y'),
                 );
             
                $wishlist=Wishlist::insert($data);
    
                $notification = array(
                    'message' => 'Product add to your wishlist !',
                    'alert-type' => 'success'
                );
         
                 return redirect()->back()->with($notification); 
            }
     
 
     }

     static function wishlist(){
        
            $userId=Session::get('user')['id'];
            $shop_id=Session::get('shop')['id'];
            return Wishlist::where('user_id',$userId)->where('shop_id',$shop_id)->count();

      
      

 
    }
    // show wishlist page

    function WishlistShow(){
        $userid=Session::get('user')['id'];
        $shop_id=Session::get('shop')['id'];
        $wishlist=Wishlist::where('user_id',$userid)->where('shop_id',$shop_id)->get();
        return view('frontend.cart.wishlist',compact('wishlist'));

    }
    // single wishlish item delete
    function WishlistDelete($id){

        $wishlist=Wishlist::where('product_id',$id)->first();
        $wishlist->delete();
        $notification = array(
            'message' => 'Item Delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }

    // wishlist clear

    function WishlistClear(){
        $userid=Session::get('user')['id'];
        $wishlist=Wishlist::where('user_id',$userid)->delete();
        $notification = array(
            'message' => 'Wishlist Clear Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }
}
