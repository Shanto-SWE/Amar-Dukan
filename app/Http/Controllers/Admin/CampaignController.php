<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use\App\Models\Campaign;
use\App\Models\Shop;
use\App\Models\Brand;
use\App\Models\Pickup_point;
use\App\Models\Product;
use Image;
use File;
use Session;
use Illuminate\Validation\Rule;

class CampaignController extends Controller
{
    // show all campaign
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Campaign::orderBy('id','DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                     ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<a href="#"><span class="badge badge-success">Active</span> </a>';
                        }else{
                            return '<a href="#"><span class="badge badge-danger">Inactive</span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>

                        <a href="'.route('campaign.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }

        return view('admin.offer.campaign.index');
    }
    //store campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_name'=>'required|unique:campaigns',
           'title' => 'required|unique:campaigns|max:55',
           'start_date' => 'required',
           'image' => 'required',
           'discount' => 'required',
        ]);

        $data=array(
            'shop_name'=>$request->shop_name,
            'title'=>$request->title,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'status'=>$request->status,
            'discount'=>$request->discount,
            'month'=>date('F'),
            'year'=>date('Y'),
        );
     
         //working with image
          $photo=$request->image;
          $slug=Str::slug($request->title, '-');
          $photoname=$slug.'.'.$photo->getClientOriginalExtension();
          $photo->move('storage/files/campaign/',$photoname);  
          $data['image']='storage/files/campaign/'.$photoname;  
         $campaign=Campaign::insert($data);
         $notification=array('message'=>'Campaign Created successfully!');
         return redirect()->back()->with($notification);
    }

    //delete method
    public function delete($id)
    {
        $data=Campaign::where('id',$id)->first();
        $image=$data->image;
        if (File::exists($image)) {
             unlink($image);
        }
        $campaign=Campaign::where('id',$id)->delete();
        $product=Product::where('campaign_id',$id)->delete();
        $notification=array('message'=>'Campaign Delete successfully!');
        return redirect()->back()->with($notification);
    }

    //campaign edit method
    public function edit($id)
    {
        $shop=Shop::where('status',1)->get();
      $data=Campaign::where('id',$id)->first();
      return view('admin.offer.campaign.edit',compact('data','shop'));
    }

    //update campaign
    public function update(Request $request)
    {
        $campaign=Campaign::where('id',$request->id)->first();
        $validated = $request->validate([
            'shop_name'=>"required|unique:campaigns,shop_name,$campaign->id",
           'title' => "required|unique:campaigns,title,$campaign->id",
           'start_date' => 'required',
           'discount' => 'required',
        ]);
        $slug=Str::slug($request->title, '-');
        $data=array(
            'shop_name'=>$request->shop_name,
            'title'=>$request->title,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'status'=>$request->status,
            'discount'=>$request->discount,
        );

        if ($request->image) {
              if (File::exists($request->old_image)) {
                     unlink($request->old_image);
                }
              $photo=$request->image;
              $photoname=$slug.'.'.$photo->getClientOriginalExtension();
              $photo->move('storage/files/campaign/',$photoname);  
              $data['image']='storage/files/campaign/'.$photoname; 
              $campaign=Campaign::where('id',$request->id)->update($data); 
              $notification=array('message'=>'Campaign Update successfully!');
              return redirect()->back()->with($notification);
        }else{
          $data['image']=$request->old_image;   
          $campaign=Campaign::where('id',$request->id)->update($data); 
          $notification=array('message'=>'Campaign Update successfully!');
          return redirect()->back()->with($notification);
        }
    }

    // campaign product show
    function campaignProduct(Request $request){
        if ($request->ajax()) {
            $imgurl='storage/files/products';
    
    
             $product="";
             $query=DB::table('products')->where('campaign_product',1)->leftJoin('shops','products.shop_id','shops.id');
    
            
                 if ($request->shop_id) {
                    $query->where('products.shop_id',$request->shop_id);
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
    
                     $product=$query->select('products.*','shops.shop_name')->where('campaign_product',1)->get();
             return DataTables::of($product)
                     ->addIndexColumn()
                     ->editColumn('thumbnail',function($row) use ($imgurl){
                         return '<img src="'.$imgurl.'/'.$row->thumbnail.'"  height="30" width="30" >';
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
                         <a href="'.route('campaign.product.view',[$row->id]).'" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                         <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a> 
                         <a href="'.route('campaign.product.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_product"><i class="fas fa-trash"></i>
                         </a>';
                        return $actionbtn;   
                     })
                     ->rawColumns(['action','thumbnail','status'])
                     ->make(true);       
         }
    

       $shop=Shop::where('status',1)->get();
       $brand=Brand::all();
         return view('admin.offer.campaign.campaignProduct.index',compact('shop','brand'));

    }

       //product create page
       public function create()
       {
           $brand=Brand::all();         
           $pickup_point=Pickup_point::all();  
           $shop=Campaign::where('status',1)->get();
           return view('admin.offer.campaign.campaignProduct.create',compact('brand','pickup_point','shop'));
       }


    //    product store method
    public function productStore(Request $request){

                                                      

                

        $campaign_id=$request->campaign_id;
        $campaign=Campaign::where('id',$campaign_id)->first();
        $shop_name=$campaign->shop_name;
        $shop=Shop::where('shop_name',$shop_name)->first();

        $shop_id=$shop->id;
        

         
        $admin=Session::get('admin');
        $admin_id=$admin->id;

       $validated = $request->validate([
           'name' => 'required|unique:products,name,NULL,id,campaign_id,' . $campaign_id,
           'quantity'=>'required',
           'code' => 'required|unique:products,code,NULL,id,campaign_id,' . $campaign_id,
           'unit' => 'required',
           'selling_price' => 'required',
           'discount_price'=> 'required',
          
        
       ]);

       $slug=Str::slug($request->name, '-');

       $data=array(
        'name'=>$request->name,
        'quantity'=>$request->quantity,
        'slug'=>Str::slug($request->name, '-'),
        'code'=>$request->code,
        'brand_id'=>$request->brand_id,
        'pickup_point_id'=>$request->pickup_point_id,
        'shop_id'=>$shop_id,
        'unit'=>$request->unit,
        'video'=>$request->video,
        'purchase_price'=>$request->purchase_price,
        'selling_price'=>$request->selling_price,
        'discount_price'=>$request->discount_price,
        'stock_quantity'=>$request->stock_quantity,
        'description'=>$request->description,
        'status'=>$request->status,
        'admin_id'=>$admin_id,
        'campaign_id'=>$request->campaign_id,
        'campaign_product'=>1,
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


   // product view
   function ProductView($id){
    $productview=product::where('id',$id)->first();
    return view('admin.offer.campaign.campaignProduct.view',compact('productview'));
      
  }

    //edit method
    public function productEdit($id)
    {

        $product=Product::where('id',$id)->first();

        $brand=Brand::all();
        $shop=Campaign::where('status',1)->get();
        $pickup_point=Pickup_point::all();
        return view('admin.offer.campaign.campaignProduct.edit',compact('product','brand','shop','pickup_point'));
    }
     //    update product
     public function productUpdate(Request $request)
     {


        $campaign_id=$request->campaign_id;
        $campaign=Campaign::where('id',$campaign_id)->first();
        $shop_name=$campaign->shop_name;
        $shop=Shop::where('shop_name',$shop_name)->first();

        $shop_id=$shop->id;
        $id=$request->id;
         // validation
         $product=Product::where('id',$id)->first();
       $validated = $request->validate([
        'name' =>  [
            'required', 
            Rule::unique('products')
            ->ignore($product->id)
                   ->where('campaign_id', $campaign_id)
        ],
           'quantity'=>'required',
           'code' =>  [
            'required', 
            Rule::unique('products')
            ->ignore($product->id)
                   ->where('campaign_id', $campaign_id)
        ],
           
           'unit' => 'required',
           'selling_price' => 'required',
        
       ]);
       $slug=Str::slug($request->name, '-');
       $admin=Session::get('admin');
       $admin_id=$admin->id;

       $data=array(
        'name'=>$request->name,
        'quantity'=>$request->quantity,
        'slug'=>Str::slug($request->name, '-'),
        'code'=>$request->code,
        'brand_id'=>$request->brand_id,
        'pickup_point_id'=>$request->pickup_point_id,
        'shop_id'=>$shop_id,
        'unit'=>$request->unit,
        'video'=>$request->video,
        'purchase_price'=>$request->purchase_price,
        'selling_price'=>$request->selling_price,
        'discount_price'=>$request->discount_price,
        'stock_quantity'=>$request->stock_quantity,
        'description'=>$request->description,
        'status'=>$request->status,
        'admin_id'=>$admin_id,
        'campaign_id'=>$request->campaign_id,
        'campaign_product'=>1,
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
            return redirect()->route('campaign.product')->with($notification);
      }else{
        $data['category_logo']=$request->old_thumbnail;	
        $product = Product::find($id);
        $product->update($data);
        $notification=array('message'=>'Product update successfully!');
        return redirect()->route('campaign.product')->with($notification);

     }
    }
       //product delete
       public function productDelete($id)
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
