<?php

use Illuminate\Support\Facades\Route;
use\App\Http\Controllers\Front\UserController;
use\App\Http\Controllers\Front\WishlistController;







Auth::routes();


// user login and register
Route::get('/user/login/email', [UserController::class,'loginwithemail'])->name('user.loginwithemail');
Route::get('/user/login/phone', [UserController::class,'loginwithphone'])->name('user.loginwithphone');
Route::get('user/logout', [UserController::class,'user_logout'])->name('user.logout');
Route::post('/user/makeloginwithemail', [UserController::class,'makeloginwithemail'])->name('user.makeloginwithemail');
Route::post('/user/makeloginwithphone', [UserController::class,'makeloginwithphone'])->name('user.makeloginwithphone');
Route::get('/user/registration/email', [UserController::class,'registerwithemail'])->name('user.registerwithemail');
Route::post('/user/registration', [UserController::class,'user_registration'])->name('user.registration');

// mail format
Route::get('/mail/format', [UserController::class,'mailformat']);


Route::group(['namespace'=>'App\Http\Controllers\Front'],function(){
    Route::get('/home-{shop_slug}', 'HomeController@home')->name('website.home');
    Route::get('/product-details/{slug}', 'HomeController@product_detalis')->name('product.details');

      // quick view cart
      Route::post('/addtocart','CartController@AddToCartQv')->name('add.to.cartqv');
      Route::get('/allcart','CartController@allcart')->name('all.cart');

      // my wishlist
      Route::get('/wishlist/show','WishlistController@WishlistShow')->name('wishlist.show');

    //   Mycart
    Route::get('/my-cart','CartController@MyCart')->name('mycart.show');
    // cart item remove
    Route::get('cartitem/remove/{rowId}','CartController@CartItemRemove');
    // cart qty update
    Route::get('cartitem/update/{rowId}/{qty}','CartController@CartQtyUpdate');
    // cart empty
    Route::get('cart/empty','CartController@CartEmpty')->name('cart.empty');
 
// quick view
Route::get('/product-quick-view/{id}','HomeController@ProductQuickView');
// subcategory list show
Route::get('/category/{slug}','HomeController@SubCategoryListShow')->name('subcategorylist.show');
// Subcategorywish product show
Route::get('/Subcategory/{slug}','HomeController@categorywishproduct')->name('categorywishproduct.show');
// district show
Route::get('/','HomeController@district')->name('district.show');

// search district
Route::get('/search/district','HomeController@districtSearch')->name('district.search');

// shop show
Route::get('/shopshow/{slug}','HomeController@shop')->name('shop.show');
// search district
Route::get('/search/shop','HomeController@shopSearch')->name('shop.search');

// brand wise product show
Route::get('/brand/product/{id}','HomeController@BrandProduct')->name('brand.product');

// page
Route::get('/page/{slug}','HomeController@Page')->name('page');
// Newsletter
Route::post('/store/newsletter','HomeController@StoreNewsletter')->name('store.newsletter');

// user forgot password
Route::get('forgot-password','ForgotController@forgetPassword')->name('password.forget');
Route::post('forget-password/link','ForgotController@resetPasswordLink')->name('password.forget.link');
  Route::get('reset-password/{token}', 'ForgotController@resetPasswordForm')->name('reset.password.form');
 Route::post('update-password','ForgotController@updatePassword' )->name('password.update');

 // user product request

Route::get('product/request','UserController@ProductRequest')->name('product.request'); 
Route::post('product/request','UserController@ProductRequestStore')->name('product.request.store'); 

// discount product

Route::get('product/discount','HomeController@ProductDiscount')->name('product.discount'); 

// campaign product show
Route::get('campaignproductshow/{title}','HomeController@campaignProductShow')->name('campaign.product.show'); 
Route::get('/campaignproduct-details/{id}', 'HomeController@campaignProduct_detalis')->name('campaign.product.details');

// search product

Route::get('product/search','HomeController@ProductSearch')->name('product.search'); 

  // order tracking
  Route::get('/order/tracking','HomeController@OrderTracking')->name('order.tracking');
  Route::post('/check/order','HomeController@CheckOrder')->name('check.order');

  // contact us
  Route::get('/contact_us','HomeController@Contact')->name('contact');
  Route::post('/contact_us','HomeController@ContactStore')->name('contact.store');
});



Route::group(['namespace'=>'App\Http\Controllers\Front','middleware'=>'userlogincheck'],function(){
// review store for produdct
 Route::post('/store/review','ReviewController@store')->name('store.review');

   // review store for webiste
  Route::get('/write/review','ReviewController@write')->name('write.review');
  Route::post('/store/website/review','ReviewController@WebReviewStore')->name('store.website.review');
  // review store for shop
   Route::get('/write/shop/review','ReviewController@shopReview')->name('write.shop.review');
   Route::post('/store/shop/review','ReviewController@ShopReviewStore')->name('store.shop.review');

  // Wishlist
   Route::get('/add/wishlist/{id}','WishlistController@AddWishlist')->name('add.wishlist');
   Route::get('/wishlist/delete/{id}','WishlistController@WishlistDelete')->name('wishlistitem.delete');
   Route::get('/wishlist/clear','WishlistController@WishlistClear')->name('wishlist.clear');


  //  get shipping cost ajax request
  Route::get('/get-shipping_cost/{districtName}','CheckoutController@GetShippingCost');

   // check out
   Route::get('check-out','CheckoutController@Checkout')->name('checkout');
  //  coupon apply
  Route::post('apply/coupon','CheckoutController@CouponApply')->name('apply.coupon');
  // order place
  Route::post('order/place','CheckoutController@OrderPlace')->name('order.place');
  // coupon delete
  Route::get('coupon/remove','CheckoutController@CouponRemove')->name('coupon.remove');

   // user dashboard
   Route::get('user/dashboard','UserController@UserDashboard')->name('user.dashboard');
   Route::get('user/password/change','UserController@UserPasswordChange')->name('user.passwordchange');
   Route::post('/user/password/update','UserController@UserPasswordUpdate')->name('user.password.update');
   Route::get('/user/profile','UserController@UserProfile')->name('user.profile');
   Route::post('/user/profile/update','UserController@UserProfileUpdate')->name('user.profile.update');

  // my order-----------------
  Route::get('my/order','UserController@MyOrder')->name('my.order');
  // user caneel order
  Route::post('my/order/cancel/{orderId}','UserController@MyOrderCancel')->name('user.order.cancel');
  // user return order request
  Route::post('my/order/return/{orderId}','UserController@MyOrderReturn')->name('user.order.return');
  Route::get('/view/order/{id}','UserController@ViewOrder')->name('view.order'); 
  // order invoice print
  Route::get('/user/order/print/{id}','UserController@OrderPrint')->name('user.order.print');

  // request  order---------------------
  Route::get('request/order','UserController@RequestOrder')->name('request.order');
  Route::get('view/request/order/{id}','UserController@ViewRequestOrder')->name('viewrequest.order');
  Route::post('my/request-order/cancel/{Id}','UserController@MyRequestOrderCancel')->name('user.request-order.cancel');

  // user return request order request
  Route::post('my/requestOrder/return/{Id}','UserController@MyRequestOrderReturn')->name('user.requestOrder.return');

  // request order invoice print
  Route::get('/user/request-order/print/{id}','UserController@RequestOrderPrint')->name('user.request-order.print');
 


   //payment gateway
   Route::post('/success','CheckoutController@success')->name('success');
   Route::post('/fail','CheckoutController@fail')->name('fail');
   Route::get('/success',function(){
    return redirect()->to('/');
})->name('cancel');


  // ticket system
   Route::get('/open/ticket','UserController@ticket')->name('open.ticket');
   Route::get('/new/ticket','UserController@NewTicket')->name('new.ticket');
   Route::post('/store/ticket','UserController@StoreTicket')->name('store.ticket');
   Route::get('/show/ticket/{id}','UserController@TicketShow')->name('ticket.show');
   Route::post('/user/ticket/reply','UserController@TicketReply')->name('ticket.reply');
   Route::get('/delete/ticket/{id}','UserController@TicketDelete')->name('ticket.delete');


  //  product ask question
  Route::post('/productAsk/question','UserController@StoreQuestion')->name('productAsk.question');
    

});

