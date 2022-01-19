<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Webreview;
use\App\Models\ShopReview;
use\App\Models\Shop;
use DB;
use DataTables;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    
    // show all website review
    function WebsiteReview(Request $request){

        if ($request->ajax()) {
    		$data=Webreview::get();
    		return DataTables::of($data)
    				->addIndexColumn()
    				->addColumn('action', function($row){
    					$actionbtn='
                      	<a href="'.route('website.review.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';
                       return $actionbtn; 	
    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        return view('admin.review.website_review');
    }

    // website review delete
    function websiteReviewDelete($id){

        $data=Webreview::where('id',$id)->first();
    
        $Webreview=Webreview::find($id);
        $Webreview->delete();
        $notification=array('message'=>'Review Deleted successfully!');
        return redirect()->route('website.review')->with($notification);
    }

    // show all shop review
    function ShopReview(Request $request){
        if ($request->ajax()) {

            $shop_review="";
            $query=DB::table('shop_reviews')->leftJoin('shops','shop_reviews.shop_id','shops.id')
    		->select('shops.shop_name','shop_reviews.*');

            if ($request->shop_id) {
                $query->where('shop_reviews.shop_id',$request->shop_id);
            }
            if ($request->rating==1) {
                $query->where('rating',$request->rating);
            }
            if ($request->rating==2) {
                $query->where('rating',$request->rating);
            }
            if ($request->rating==3) {
                $query->where('rating',$request->rating);
            }
            if ($request->rating==4) {
                $query->where('rating',$request->rating);
            }
            if ($request->rating==5) {
                $query->where('rating',$request->rating);
            }
    	
            $shop_review=$query->get();
    		return DataTables::of($shop_review)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='
                      	<a href="'.route('shop.review.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $shop=Shop::where('status',1)->get();
        return view('admin.review.shop_review',compact('shop'));

    }
    // shop review delete

    function ShopReviewDelete($id){
       
    
        $ShopReview=ShopReview::find($id);
        $ShopReview->delete();
        $notification=array('message'=>'Review Deleted successfully!');
        return redirect()->route('shop.review')->with($notification);

    }

}
