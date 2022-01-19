<?php

use Illuminate\Support\Facades\Route;
use\App\Http\Controllers\Admin\AdminController;
use\App\Http\Controllers\Admin\ForgetPassword;


// admin login
 Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
 Route::post('/makelogin', [AdminController::class, 'makeLogin'])->name('admin.makelogin');

 // admin forgot password
 Route::get('admin/forgot-password', [ForgetPassword::class, 'forgetPassword'])->name('admin.password.forget');
 Route::post('admin/forget-password/link',[ForgetPassword::class, 'resetPasswordLink'])->name('admin.resetpassword.link');
 Route::get('admin/reset-password/{token}', [ForgetPassword::class, 'resetPasswordFrom'])->name('admin.resetpassword.form');
 Route::post('admin/reset-password',[ForgetPassword::class, 'resetPassword'])->name('admin.password.reset');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'adminlogincheck'],function(){
    Route::get('/admin/home','AdminController@admin')->name('admin.home');
     Route::get('/admin/logout','AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change','AdminController@passwordChange')->name('admin.password.change');
     Route::post('/admin/password/update','AdminController@passwordUpdate')->name('admin.password.update');

    //   review
    Route::group(['prefix'=>'review'],function(){

        // website review
        Route::get('/website_review','ReviewController@WebsiteReview')->name('website.review');
         Route::get('website/delete/{id}','ReviewController@websiteReviewDelete')->name('website.review.delete');
     
      // Shop review
        Route::get('/shop_review','ReviewController@ShopReview')->name('shop.review');
         Route::get('/delete/{id}','ReviewController@ShopReviewDelete')->name('shop.review.delete');
        });
// user details
    Route::group(['prefix'=>'admin'],function(){
    Route::get('/user','UserController@index')->name('user.index');
    Route::delete('/user/delete/{id}','UserController@delete')->name('user.delete');
    Route::get('/user/view/{id}','UserController@userView')->name('user.view');
    // user export
    Route::get('/user/export','UserController@userExport')->name('export.user');

    });

//global route 
Route::get('/get-category/{id}','CategoryController@GetCategory');
Route::get('/get-sub-category/{id}','CategoryController@GetSubCategory');


    // Category route
    Route::group(['prefix'=>'category'],function(){
    Route::get('/','CategoryController@index')->name('category.index');
    Route::post('/store','CategoryController@store')->name('category.store');
    Route::get('/delete/{id}','CategoryController@delete')->name('category.delete');
    Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');;  
    Route::post('/update','CategoryController@update')->name('category.update'); 
    });
 

    // SubCategory route
    Route::group(['prefix'=>'subcategory'],function(){
    Route::get('/','SubCategoryController@index')->name('subcategory.index');
    Route::post('/store','SubCategoryController@store')->name('subcategory.store');
    Route::get('/delete/{id}','SubCategoryController@delete')->name('subcategory.delete');
    Route::get('/edit/{id}','SubCategoryController@edit')->name('subcategory.edit'); 
    Route::post('/update','SubCategoryController@update')->name('subcategory.update'); 
    });
        
                     //district routes
	     Route::group(['prefix'=>'district'], function(){
            Route::get('/','DistrictController@index')->name('district.index');
            Route::post('/store','DistrictController@store')->name('district.store');
             Route::get('/delete/{id}','DistrictController@delete')->name('district.delete');
             Route::get('/edit/{id}','DistrictController@edit');
            Route::post('/update','DistrictController@update')->name('district.update');
        });
        // show shop district wish chart
        Route::get('/district-wish/shop/report','DistrictController@showShopReport')->name('district.shop.report');

            //Shop routes
	     Route::group(['prefix'=>'shop'], function(){
		Route::get('/','ShopController@index')->name('shop.index');
		Route::post('/store','ShopController@store')->name('shop.store');
		 Route::get('/delete/{id}','ShopController@delete')->name('shop.delete');
		 Route::get('/edit/{id}','ShopController@edit');
		Route::post('/update','ShopController@update')->name('shop.update');
        Route::get('/active-status/{id}','ShopController@activestatus');
        Route::get('/not-status/{id}','ShopController@notstatus');
        Route::get('/view/{id}','ShopController@shopView')->name('shop.view');
         // shop export
         Route::get('/export','ShopController@shopExport')->name('export.shop');
	});
    
           // Brand route
            Route::group(['prefix'=>'brand'],function(){
            Route::get('/','BrandController@index')->name('brand.index');
            Route::post('/store','BrandController@store')->name('brand.store');
            Route::get('/delete/{id}','BrandController@delete')->name('brand.delete');
            Route::get('/edit/{id}','BrandController@edit')->name('brand.edit'); 
            Route::post('/update','BrandController@update')->name('brand.update'); 
            });
                // shipping cost route
                Route::group(['prefix'=>'shipping-cost'],function(){
                    Route::get('/','ShippingCost@index')->name('shipping-cost.index');
                     Route::post('/store','ShippingCost@store')->name('shipping_cost.store');
                    Route::get('/delete/{id}','ShippingCost@delete')->name('shipping_cost.delete');
                     Route::get('/edit/{id}','ShippingCost@edit')->name('shipping_cost.edit'); 
                     Route::post('/update','ShippingCost@update')->name('shipping_cost.update'); 
                    });
        //product routes
     	Route::group(['prefix'=>'product'], function(){
		Route::get('/','ProductController@index')->name('product.index');
		 Route::get('/create','ProductController@create')->name('product.create');
		 Route::post('/store','ProductController@store')->name('product.store');
		 Route::delete('/delete/{id}','ProductController@delete')->name('product.delete');
		 Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
		Route::post('/update','ProductController@update')->name('product.update');
		 Route::get('/active-featured/{id}','ProductController@activefeatured');
		Route::get('/not-featured/{id}','ProductController@notfeatured');
		  Route::get('/active-deal/{id}','ProductController@activedeal');
		 Route::get('/not-deal/{id}','ProductController@notdeal');
		 Route::get('/active-status/{id}','ProductController@activestatus');
		 Route::get('/not-status/{id}','ProductController@notstatus');
         Route::get('/view/{id}','ProductController@ProductView')->name('product.view');
	});

        //Coupon Routes
	    Route::group(['prefix'=>'coupon'], function(){
		Route::get('/','CouponController@index')->name('coupon.index');
		Route::post('/store','CouponController@store')->name('coupon.store');
		Route::delete('/delete/{id}','CouponController@delete')->name('coupon.delete');
		Route::get('/edit/{id}','CouponController@edit');
		Route::post('/update','CouponController@update')->name('coupon.update');
	});
    	//Campaign Routes
	    Route::group(['prefix'=>'campaign'], function(){
		Route::get('/','CampaignController@index')->name('campaign.index');
		Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::get('/delete/{id}','CampaignController@delete')->name('campaign.delete');
		Route::get('/edit/{id}','CampaignController@edit');
		Route::post('/update','CampaignController@update')->name('campaign.update');

        
	});
    // Campaign product route
    Route::group(['prefix'=>'campaignProduct'], function(){
    Route::get('/','CampaignController@campaignProduct')->name('campaign.product');
    Route::get('/create','CampaignController@create')->name('campaign.product.create');
    Route::post('/store','CampaignController@productStore')->name('campaign.product.store');
    Route::get('/view/{id}','CampaignController@ProductView')->name('campaign.product.view');
    Route::get('/edit/{id}','CampaignController@productEdit')->name('campaign.product.edit');
    Route::post('/update','CampaignController@productUpdate')->name('campaign.product.update');
    Route::delete('/delete/{id}','CampaignController@productDelete')->name('campaign.product.delete');


           
	});


       //Pickup Point
		Route::group(['prefix'=>'pickup-point'], function(){
			Route::get('/','PickupController@index')->name('pickuppoint.index');
			Route::post('/store','PickupController@store')->name('store.pickup.point');
			Route::delete('/delete/{id}','PickupController@delete')->name('pickup.point.delete');
			Route::get('/edit/{id}','PickupController@edit');
			Route::post('/update','PickupController@update')->name('update.pickup.point');
	    });
            //Ticket
		Route::group(['prefix'=>'ticket'], function(){
			Route::get('/','TicketController@index')->name('ticket.index');
			Route::get('/show/{id}','TicketController@ShowTicket')->name('admin.ticket.show');
			Route::delete('/delete/{id}','TicketController@destroy')->name('admin.ticket.delete');
            Route::post('/reply','TicketController@ReplyTicket')->name('admin.store.reply');
		    Route::get('/close/{id}','TicketController@CloseTicket')->name('admin.close.ticket');
            

		
	    });
                //Order
		Route::group(['prefix'=>'admin/order'], function(){
			Route::get('/','OrderController@index')->name('admin.order.index');
            Route::get('/edit/{id}','OrderController@EditOrder');
            Route::get('/view/{id}','OrderController@ViewOrder')->name('admin.view.order');
             Route::post('/update','OrderController@UpdateStatus')->name('update.order.status');
             Route::post('/change/status','OrderController@ChangeStatus')->name('update.change.status');
             Route::get('/delete/{id}','OrderController@OrderDelete')->name('admin.order.delete');
             Route::get('/view/invoice/{id}','OrderController@viewInvoice')->name('admin.view.invoice');
            // order invoice print
              Route::get('/print/{id}','OrderController@OrderPrint')->name('order.print');
            // order export
             Route::get('/export','OrderController@orderExport')->name('export.order');
        
	    });
            // return order
            Route::group(['prefix'=>'return_order'], function(){
                Route::get('/','ReturnOrder@index')->name('return.order.index');
                Route::get('/edit/{id}','ReturnOrder@EditRequestStatus');
                Route::post('/update','ReturnOrder@UpdateStatus')->name('return.order.update');
               
            
            });
    

                // Request Order
                Route::group(['prefix'=>'admin/request-order'], function(){
                Route::get('/','RequestOrder@index')->name('admin.request-order.index');
                Route::get('/view/{id}','RequestOrder@ViewOrder')->name('admin.request-order.view');
                Route::post('/change/status','RequestOrder@ChangeStatus')->name('change.request-order.status');
                 Route::get('/delete/{id}','RequestOrder@OrderDelete')->name('admin.request-order.delete');
                 Route::get('/view/invoice/{id}','RequestOrder@viewInvoice')->name('admin.view.request-order.invoice');
                         // order invoice print
              Route::get('/print/{id}','RequestOrder@OrderPrint')->name('request-order.print');
                    
                });
                   // Contact message
                   Route::group(['prefix'=>'Contact-message'], function(){
                    Route::get('/','ContactController@index')->name('contact.message');
                    Route::get('/delete/{id}','ContactController@Delete')->name('contact.delete');

        
                
                });
                 

             // setting route
           Route::group(['prefix'=>'setting'],function(){
              
            //seo setting
		        Route::group(['prefix'=>'seo'], function(){
		     	Route::get('/','SettingController@seo')->name('seo.setting');
		     	Route::post('/update/{id}','SettingController@seoUpdate')->name('seo.setting.update');
	           });  
               
               //smtp setting
		        Route::group(['prefix'=>'smtp'], function(){
		     	Route::get('/','SettingController@smtp')->name('smtp.setting');
			    Route::post('/update/{id}','SettingController@smtpUpdate')->name('smtp.setting.update');
                });
                    //website setting
                    Route::group(['prefix'=>'website'], function(){
                        Route::get('/','SettingController@website')->name('website.setting');
                         Route::post('/update/{id}','SettingController@WebsiteUpdate')->name('website.setting.update');
                    });

             //payment gateway
		   Route::group(['prefix'=>'payment-gateway'], function(){
			Route::get('/','SettingController@PaymentGateway')->name('payment.gateway');
			 Route::post('/update-aamarpay','SettingController@AamarpayUpdate')->name('update.aamarpay');
		
	    });
                //Page setting
                Route::group(['prefix'=>'page'], function(){
                    Route::get('/','PageController@index')->name('page.index');
                    Route::get('/create','PageController@create')->name('create.page');
                    Route::post('/store','PageController@store')->name('page.store');
                     Route::get('/delete/{id}','PageController@delete')->name('page.delete');
                    Route::get('/edit/{id}','PageController@edit')->name('page.edit');
                    Route::post('/update/{id}','PageController@update')->name('page.update');
                });


            });
            
    // report route

    // product report index
    Route::get('/product-report','ReportController@ProductReport')->name('product.report');
    // shop report index
    Route::get('/shop-report','ReportController@ShopReport')->name('shop.report');
           // setting route
           Route::group(['prefix'=>'report'],function(){
              
            //order report
		        Route::group(['prefix'=>'order'], function(){
		     	Route::get('/','ReportController@OrderReport')->name('order.report');
		     	 Route::get('/print','ReportController@OrderReportPrint')->name('report.order.print');
	           });  
                    // customer report
		        Route::group(['prefix'=>'customer'], function(){
                    Route::get('/','ReportController@CustomerReport')->name('customer.report');
                     Route::get('/print','ReportController@CustomerReportPrint')->name('report.customer.print');
                  });  
                    // product report
		        Route::group(['prefix'=>'product'], function(){
                  
                    Route::get('/print','ReportController@ProductReportPrint')->name('report.product.print');
                  });  

                // shop report
		        Route::group(['prefix'=>'shop'], function(){
              
                     Route::get('/print','ReportController@ShopReportPrint')->name('report.shop.print');
                  });  
   
	    });
      
        // report chart route
        Route::group(['prefix'=>'report-chart'],function(){
               
              // customer report chart
		        Route::group(['prefix'=>'customer'], function(){
             Route::get('/','ReportController@CustomerReportChart')->name('customer.report.chart');
                    
                  });  
               // order report chart
		        Route::group(['prefix'=>'order'], function(){
            Route::get('/','ReportController@OrderReportChart')->name('order.report.chart');
                    
                  });  
              // shop report chart
		        Route::group(['prefix'=>'shop'], function(){
              Route::get('/','ReportController@ShopReportChart')->name('shop.report.chart');
              
            });  
                 

	    });



        // role management
        Route::group(['prefix'=>'role'], function(){
            Route::get('/','RoleController@index')->name('role.index');
            Route::get('/create','RoleController@create')->name('role.create');
            Route::post('/store','RoleController@store')->name('role.store');
            Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
            Route::post('/update/{id}','RoleController@update')->name('role.update');
            Route::get('/delete/{id}','RoleController@delete')->name('role.delete');
            
        });
        // newsletter subscriber
        Route::group(['prefix'=>'subscriber'], function(){
            Route::get('/','SubscriberController@index')->name('subscriber.index');
            Route::get('/active-status/{id}','SubscriberController@activeStatus');
            Route::get('/deactive-status/{id}','SubscriberController@deactiveStatus');
            Route::get('/delete/{id}','SubscriberController@delete')->name('subscriber.delete');
   
            
        });


         // message  notification
         Route::get('/message/status/change/','AdminController@MessageStatusChange')->name('message.status.change');

        // all  notification
        Route::get('/all-notification','AdminController@AllNotification')->name('admin.all.notification');
        Route::get('/notification/status/change/','AdminController@NotificationStatusChange')->name('notification.status.change');
        Route::get('/seen/status/change/{id}','AdminController@SeenStatusChange')->name('notification.status.change');
        Route::get('/clear/notificatoin','AdminController@ClearAll')->name('clear.notification');

        

});
