<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\ShopReview;
use DB;
use DataTables;
use Session;
use Illuminate\Support\Str;

class ShopReviewController extends Controller
{
        // show all shop review
        function ShopReview(Request $request){
            $shop=Session::get('shoper');
            $id=$shop->id;
            if ($request->ajax()) {

                $shop_review="";
                $query=ShopReview::where('shop_id',$id);


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
                              <a href="'.route('shoper.review.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                              </a>';
    
                           return $actionbtn; 	
    
                        })
                        ->rawColumns(['action'])
                        ->make(true);		
            }
    
            return view('shoper.review.shop_review');
    
        }

            // shop review delete

    function ShopReviewDelete($id){
        $data=ShopReview::where('id',$id)->first();
    
        $ShopReview=ShopReview::find($id);
        $ShopReview->delete();
        $notification=array('message'=>'Review Deleted successfully!');
        return redirect()->route('shoper.review')->with($notification);

    }
}
