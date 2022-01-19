<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Categories;
use\App\Models\SubCategories;
use\App\Models\childcategories;
use\App\Models\Brand;
use\App\Models\Pickup_point;
use\App\Models\Shop;
use\App\Models\Product;
use DataTables;
use Auth;
use Illuminate\Support\Str;
use Image;
use DB;
use File;
use Session;
use Illuminate\Validation\Rule;



class ProductController extends Controller
{
    function index(Request $request){


        if ($request->ajax()) {

            
        $shop=Session::get('shoper');
        $id=$shop->id;
        $imgurl='storage/files/products';

          
            $product="";
            $query=DB::table('products')->where('products.shop_id',$id)->leftJoin('categories','products.category_id','categories.id')
                  ->leftJoin('sub_categories','products.subcategory_id','sub_categories.id');
   
                  if ($request->category_id) {
                   $query->where('products.category_id',$request->category_id);
                }
            
               if ($request->brand_id) {
                   $query->where('products.brand_id',$request->brand_id);
               }
               if ($request->status==1) {
                   $query->where('products.status',1);
               }
               if ($request->status==0) {
                   $query->where('products.status',0);
               }
   
                    $product=$query->select('products.*','categories.category_name','sub_categories.Subcategory_name')->where('products.shop_id',$id)
                       ->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('productlogo',function($row) use ($imgurl){
                        return '<img src="'.$imgurl.'/'.$row->thumbnail.'"  height="30" width="30" >';
                    })
               
                   ->editColumn('featured',function($row){
                       if ($row->featured==1) {
                           return '<a href="#" data-id="'.$row->id.'" class="deactive_featurd"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                       }else{
                           return '<a href="#" data-id="'.$row->id.'" class="active_featurd"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                       }
                   })
                   ->editColumn('today_deal',function($row){
                       if ($row->today_deal==1) {
                           return '<a href="#" data-id="'.$row->id.'" class="deactive_deal"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                       }else{
                           return '<a href="#" data-id="'.$row->id.'" class="active_deal"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                       }
                   })
                   ->editColumn('status',function($row){
                       if ($row->status==1) {
                           return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                       }else{
                           return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-danger"></i> <span class="badge badge-danger">deactive</span> </a>';
                       }
                   })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a> 
                        <a href="'.route('shoper.product.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_product"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','productlogo','featured','today_deal','status'])
                    ->make(true);       
        }
      $shop=Session::get('shoper');
      $id=$shop->id;
      $category=Categories::where('shop_id',$id)->get();
      $brand=Brand::all();
        return view('shoper.product.index',compact('category','brand'));
    }

   
       //product create page
       public function create()
       {
        $shop=Session::get('shoper');
        $shop_id=$shop->id;
           $category=Categories::where('shop_id',$shop_id)->get();  
           $brand=Brand::all();         
           $pickup_point=Pickup_point::all();  
           $shop=Shop::where('status',1)->get();
           return view('shoper.product.create',compact('category','brand','pickup_point','shop'));
       }
    //    store product method
    public function store(Request $request)
    {
        $shop=Session::get('shoper');
        $id=$shop->id;
       $validated = $request->validate([
       
          'name' => 'required|unique:products,name,NULL,id,shop_id,' . $id,
           'quantity'=>'required',
           'code' => 'required|unique:products,code,NULL,id,shop_id,' . $id,
           'subcategory_id' => 'required',
           'unit' => 'required',
           'selling_price' => 'required',
    
        
       ]);

       //subcategory call for category id
       $subcategory=SubCategories::where('id',$request->subcategory_id)->first();
       $slug=Str::slug($request->name, '-');


       $data=array(
       'name'=>$request->name,
       'quantity'=>$request->quantity,
       'slug'=>Str::slug($request->name, '-'),
       'code'=>$request->code,
       'category_id'=>$request->category_id,
       'subcategory_id'=>$request->subcategory_id,
       'brand_id'=>$request->brand_id,
       'pickup_point_id'=>$request->pickup_point_id,
       'shop_id'=>$id,
       'unit'=>$request->unit,
       'tags'=>$request->tags,
       'video'=>$request->video,
       'purchase_price'=>$request->purchase_price,
       'selling_price'=>$request->selling_price,
       'discount_price'=>$request->discount_price,
       'stock_quantity'=>$request->stock_quantity,
       'description'=>$request->description,
       'featured'=>$request->featured,
       'today_deal'=>$request->today_deal,
       'product_slider'=>$request->product_slider,
       'status'=>$request->status,
       'date'=>date('d-m-Y'),
       'month'=>date('F'),
       );

       //Product thumbnail
 
             $thumbnail=$request->thumbnail;
             $photoname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
             $thumbnail->move('storage/files/products/',$photoname);  
     
             $data['thumbnail']=$photoname;  
       
      
       $product=Product::insert($data);
       $notification=array('message'=>'Product Inserted successfully!');
       return redirect()->back()->with($notification);
     

    }
    
       //edit method
       public function edit($id)
       {
           $shop=Session::get('shoper');
           $shopid=$shop->id;

           $product=Product::where('id',$id)->first();
           $category=Categories::where('shop_id',$shopid)->get();
           $single_category=Categories::where('shop_id',$shopid)->first();
           $category_id=$single_category->id;
           $subcategory=SubCategories::where('category_id',$category_id)->get();

           $brand=Brand::all();
           $pickup_point=Pickup_point::all();
           return view('shoper.product.edit',compact('product','category','subcategory','brand','pickup_point'));
       }

    //    update product
    public function update(Request $request)
    {

        $shop=Session::get('shoper');
        $shopid=$shop->id;
        $id=$request->id;
         // validation
         $product=Product::where('id',$id)->first();
       $validated = $request->validate([
        'name' =>  [
            'required', 
            Rule::unique('products')
            ->ignore($product->id)
                   ->where('shop_id', $shopid)
        ],
           'quantity'=>'required',
           'code' =>  [
            'required', 
            Rule::unique('products')
            ->ignore($product->id)
                   ->where('shop_id', $shopid)
        ],
           'subcategory_id' => 'required',
           'unit' => 'required',
           'selling_price' => 'required',
        
       ]);

       //subcategory call for category id
       $subcategory=SubCategories::where('id',$request->subcategory_id)->first();
       $slug=Str::slug($request->name, '-');
  

       $data=array(
        'name'=>$request->name,
        'quantity'=>$request->quantity,
        'slug'=>Str::slug($request->name, '-'),
        'code'=>$request->code,
        'category_id'=>$subcategory->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'childcategory_id'=>$request->childcategory_id,
        'brand_id'=>$request->brand_id,
        'pickup_point_id'=>$request->pickup_point_id,
        'shop_id'=>$shopid,
        'unit'=>$request->unit,
        'tags'=>$request->tags,
        'video'=>$request->video,
        'purchase_price'=>$request->purchase_price,
        'selling_price'=>$request->selling_price,
        'discount_price'=>$request->discount_price,
        'stock_quantity'=>$request->stock_quantity,
        'description'=>$request->description,
        'featured'=>$request->featured,
        'today_deal'=>$request->today_deal,
        'product_slider'=>$request->product_slider,
        'status'=>$request->status,
        'date'=>date('d-m-Y'),
        'month'=>date('F'),
       );

       //Product thumbnail

       if($request->thumbnail) {
        if (File::exists($request->old_thumbnail)) {
               unlink($request->old_thumbnail);
          }
        $thumbnail=$request->thumbnail;
        $photoname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
        $thumbnail->move('storage/files/products/',$photoname);  
        $data['thumbnail']=$photoname;  
        $product = Product::find($id);
        $product->update($data);
        $notification=array('message'=>'Product update successfully!');
        return redirect()->route('shoper.product.index')->with($notification);
  }else{
    $data['category_logo']=$request->old_thumbnail;	
    $product = Product::find($id);
    $product->update($data);
    $notification=array('message'=>'Product update successfully!');
    return redirect()->route('shoper.product.index')->with($notification);
}

    }
 
    //product delete
    public function delete($id)
    {
        $product=Product::find($id);
        $image=$product->thumbnail;

    	if (File::exists($image)) {
    		 unlink($image);
    	}
        $product->delete();
        return response()->json('Successfully deleted!');
    }


}
