<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use\App\Models\Product;
use\App\Models\Wishlist;
use\App\Models\Shop;
use Session;

class CartController extends Controller
{
    function AddToCartQv(Request $request){
       $product=Product::find($request->id);
       $shop_id=$product->shop_id;

       $shop=Shop::where('id',$shop_id)->first();
       $shopname=$shop->shop_name;


       Cart::add([

        'id'=>$request->id,
        'name'=>$request->name,
        'qty'=>$request->qty,
        'price'=>$request->price,
        'weight'=>'1',
        'options'=>['thumbnail'=>$product->thumbnail,'shop_name'=>$shopname,'product_weight'=>$product->quantity]
       ]);
    

       return response()->json('Added Item To Your Cart');
       $user=Session::get('user');
       $userid=$user->id;
       $wishlist=Wishlist::where('user_id',$userid)->where('product_id',$product->id)->first();
       if($wishlist){
          $wishlist->delete();
       }
    }

    // all cart
    function allcart(){

        $data=array(
            'cart_qty'=>Cart::count(),
            'cart_total'=>Cart::total(),
        );
        return response()->json($data);
    }

    // mycart page
    function MyCart(){

       $content=Cart::content();
       
      return view('frontend.cart.cart',compact('content'));
    }

    // cart item remove

    function CartItemRemove($rowId){
        Cart::remove($rowId);
        return response()->json('Successfully delete!');

    }

    // cart qty update
    function CartQtyUpdate($rowId,$qty){
        Cart::update($rowId,['qty'=>$qty]);
        return response()->json('Successfully Updated!');

    }

    // cart empty
    function CartEmpty(){

        Cart::destroy();
        return response()->json('Successfully Clear!');
    }
    
}
