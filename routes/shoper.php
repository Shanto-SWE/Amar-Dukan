<?php

use Illuminate\Support\Facades\Route;
use\App\Http\Controllers\Shoper\ShoperController;
use\App\Http\Controllers\Shoper\ForgotPassword;

Auth::routes();

// shoper login
Route::get('/shopkeeper/login', [ShoperController::class, 'ShoperLogin'])->name('shoper.login');
Route::post('/make/login', [ShoperController::class, 'makeLogin'])->name('shoper.makelogin');
Route::get('/shopkeeper/registration', [ShoperController::class, 'ShoperRegistration'])->name('shoper.registration');
Route::post('/shopkeeper/makeregistration', [ShoperController::class, 'ShoperMakeRegistration'])->name('shoper.makeregistration');

// forgot password
Route::get('shopkeeper/forgot-password', [ForgotPassword::class, 'forgetPassword'])->name('shoper.password.forget');
Route::post('shopkeeper/forget-password/link',[ForgotPassword::class, 'resetPasswordLink'])->name('shoper.resetpassword.link');
 Route::get('shopkeeper/reset-password/{token}', [ForgotPassword::class, 'resetPasswordFrom'])->name('shoper.resetpassword.form');
 Route::post('shopkeeper/reset-password',[ForgotPassword::class, 'resetPassword'])->name('shoper.password.reset');

Route::group(['namespace'=>'App\Http\Controllers\Shoper','middleware'=>'shoperlogincheck'],function(){
    Route::get('/shopkeeper/home','ShoperController@Shoper')->name('shoper.home');
    Route::get('shopkeeper/logout','ShoperController@logout')->name('shoper.logout');

//global route 
Route::get('/shopkeeper/get-sub-category/{id}','CategoryController@GetSubCategory');
    

    // category index page
    Route::get('/shop-category','CategoryController@index')->name('shoper.category.index');
    // category routes
    Route::group(['prefix'=>'shopkeeper/category'],function(){
      Route::post('/store','CategoryController@store')->name('shoper.category.store');
       Route::get('/delete/{id}','CategoryController@delete')->name('shoper.category.delete');
       Route::get('/edit/{id}','CategoryController@edit')->name('shoper.category.edit');;  
       Route::post('/update','CategoryController@update')->name('shoper.category.update'); 
      });
      // sub category index page
      Route::get('/shop-subcategory','Sub_CategoryController@index')->name('shoper.subcategory.index');
 // SubCategory route
 Route::group(['prefix'=>'shopkeeper/subcategory'],function(){
   Route::post('/store','Sub_CategoryController@store')->name('shoper.subcategory.store');
   Route::get('/delete/{id}','Sub_CategoryController@delete')->name('shoper.subcategory.delete');
   Route::get('/edit/{id}','Sub_CategoryController@edit')->name('shoper.subcategory.edit'); 
  Route::post('/update','Sub_CategoryController@update')->name('shoper.subcategory.update'); 
  });

        // product index page
        Route::get('/shopkeeper-product','ProductController@index')->name('shoper.product.index');
            //product routes
            Route::group(['prefix'=>'shopkeeper'], function(){
                 Route::get('/product/create','ProductController@create')->name('shoper.product.create');
                 Route::post('/product/store','ProductController@store')->name('shoper.product.store');
                 Route::delete('/product/delete/{id}','ProductController@delete')->name('shoper.product.delete');
                Route::get('/product/edit/{id}','ProductController@edit')->name('shoper.product.edit');
                Route::post('product/update','ProductController@update')->name('shoper.product.update');
            
            });

            // product question
            Route::get('/product-question','ProductQuestion@productQuestion')->name('shoper.product.question');
            Route::get('/product/question/show/{id}','ProductQuestion@productQuestionShow')->name('product.question.show');
            Route::post('/product/answer','ProductQuestion@productAnswer')->name('product.answer');

             //Order route
             Route::group(['prefix'=>'shopkeeper/order'], function(){
                Route::get('/','OrderController@index')->name('shoper.order.index');
                 Route::get('/view/{id}','OrderController@ViewOrder')->name('shoper.order.view');
                  Route::get('/delete/{id}','OrderController@OrderDelete')->name('shoper.order.delete');
                  Route::get('/view/invoice/{id}','OrderController@ViewInvoice')->name('shopkeeper.view.invoice');
                // order invoice print
              Route::get('/print/{id}','OrderController@OrderPrint')->name('shoper.order.print');
            
            });

              // Request Order
              Route::group(['prefix'=>'shopkeeper/request-order'], function(){
                Route::get('/','RequestOrder@index')->name('shoper.request-order.index');
                Route::get('/view/{id}','RequestOrder@ViewOrder')->name('shoper.request-order.view');;
                Route::get('/delete/{id}','RequestOrder@OrderDelete')->name('shoper.request-order.delete');
                Route::get('/view/invoice/{id}','RequestOrder@ViewInvoice')->name('shopkeeper.view.request_order.invoice');
                // order invoice print
              Route::get('/print/{id}','RequestOrder@OrderPrint')->name('shoper.request-order.print');
            
            });
              // return order
              Route::group(['prefix'=>'shopkeeper/return_order'], function(){
                Route::get('/','ReturnOrder@index')->name('shopkeeper.return.order.index');
        
               
            
            });
            // shop review
            Route::group(['prefix'=>'review'], function(){
                Route::get('/shopkeeper/shop_review','ShopReviewController@ShopReview')->name('shoper.review');
                Route::get('/shopreview/delete/{id}','ShopReviewController@ShopReviewDelete')->name('shoper.review.delete');
   
           });

        //     shoper password change
        Route::get('shopkeeper/password/change','ShoperController@ShoperPasswordChange')->name('shoper.passwordchange');
        Route::post('/shopkeeper/password/update','ShoperController@ShoperPasswordUpdate')->name('shoper.password.update');
        //   shoper profile update
        Route::get('/shopkeeper/profile','ShoperController@ShoperProfile')->name('shoper.profile');
        Route::post('/shopkeeper/profile/update','ShoperController@ShoperProfileUpdate')->name('shoper.profile.update');

     // all  notification
     Route::get('/shopkeeper/all-notification','ShoperController@ShoperAllNotification')->name('shoper.all.notification');
    Route::get('/shopkeeper/notification/status/change/','ShoperController@ShoperNotificationStatusChange')->name('shoper.notification.status.change');
    Route::get('/shopkeeper/seen/status/change/{id}','ShoperController@ShoperSeenStatusChange')->name('shoper.notification.status.change');
    Route::get('/shopkeeper/clear/notificatoin','ShoperController@ShoperClearAll')->name('shoper.clear.notification');
    });