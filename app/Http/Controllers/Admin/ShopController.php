<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Shop;
use\App\Models\District;

use Illuminate\Support\Str;
use File;
use Image;
use DB;
use Hash;
use Mail;
use DataTables;
use App\Exports\shopExport;
use Maatwebsite\Excel\Facades\Excel;
class ShopController extends Controller
{
   
      // show all shop
      function index(Request $request){

        if ($request->ajax()) {

            $shop="";
          $query=DB::table('shops')->orderBy('id','DESC')->leftJoin('districts','shops.district_id','districts.id')
          ->select('districts.district_name','shops.*');

          if ($request->district_id) {
            $query->where('district_id',$request->district_id);
        }

        if ($request->status==0) {
            $query->where('shops.status',0);
        }
        if ($request->status==1) {
            $query->where('shops.status',1);
        }

     
    
        $shop=$query->get();
          return DataTables::of($shop)
                  ->addIndexColumn()
                  ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                    }else{
                        return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-danger"></i> <span class="badge badge-danger">deactive</span> </a>';
                    }
                })
                  ->addColumn('action', function($row){
                      $actionbtn='<a href="'.route('shop.view',[$row->id]).'" class="btn btn-info btn-sm edit" ><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      <a href="'.route('shop.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      </a>';
                     return $actionbtn;   
                  })
                  ->rawColumns(['action','status'])
                  ->make(true);       
      }

      $district=District::where('status',1)->get();
        return view('admin.category.shop.index',compact('district'));
    }

      //store method
      public function store(Request $request)
      {
        $validatedData = $request->validate([
            'shop_name'=>'required|unique:shops|max:55',
            'shop_owner_email' => 'required|unique:shops|regex:/(.+)@(.+)\.(.+)/i',

         
        ]);
        $district=District::where('id',$request->district_id)->first();
        $district_name=$district->district_name;
        
        $slug=Str::slug($request->shop_name, '-');
        $shop = Shop::create([
            'shop_name'=>$request->shop_name,
            'shop_owner_name'=>$request->shop_owner_name,
            'shop_owner_email'=>$request->shop_owner_email,
            'shop_slug' => Str::slug($request->shop_name, '-'),
            'shop_city'=>$request->shop_city,
            'district_id'=>$request->district_id,
            'district_name'=>$district_name,
            'shop_area'=>$request->shop_area,
            'shop_phone'=>$request->shop_phone,
            'shop_another_phone'=>$request->shop_another_phone,
            'open_time'=>$request->open_time,
            'close_time'=>$request->close_time,
            'password'=>Hash::make($request->password),
        ]);
               // working with owner photo
               $photo=$request->owner_photo;
               $photoname=$slug.'.'.$photo->getClientOriginalExtension();
               $photo->move('storage/files/shop_owner_photo/',$photoname);
        
               $shop->shop_owner_photo='storage/files/shop_owner_photo/'.$photoname;  
               $shop->save();
      //  working with shop photo
       $photo=$request->shop_photo;
       $photoname=$slug.'.'.$photo->getClientOriginalExtension();
       $photo->move('storage/files/shop_image/',$photoname);

       $shop->shop_photo='storage/files/shop_image/'.$photoname;  
       $shop->save();
        $notification=array('message'=>'shop create successfully!');
         return redirect()->route('shop.index')->with($notification);
      }

         //delete shop
    public function delete($id)
    {
        $shop=Shop::find($id);
        $photo=$shop->shop_photo;
        $ownerphoto=$shop->shop_owner_photo;

    	if (File::exists($ownerphoto)) {
            unlink($ownerphoto);
       }
    	if (File::exists($photo)) {
    		 unlink($photo);
    	}
         $shop->delete();
         $notification=array('message'=>'Shop delete successfully!');
         return redirect()->route('shop.index')->with($notification);

    }
    // edit shop
    public function edit($id)
    {
        $shop=Shop::where('id',$id)->first();
        $district=District::all();
        return view('admin.category.shop.edit',compact('shop','district'));
    }
    // update shop
    public function update(Request $request)
    {
        $id = $request->id;
        // validation
        $shop=Shop::where('id',$id)->first();
        $this->validate($request, [
           'shop_name' => "required|unique:shops,shop_name,$shop->id",
           'shop_owner_email' => "required|unique:shops,shop_owner_email,$shop->id",
           'shop_phone' => "required|unique:shops,shop_phone,$shop->id",
           'shop_another_phone' => "unique:shops,shop_another_phone,$shop->id",
          
       ]);
       $district=District::where('id',$request->district_id)->first();
       $district_name=$district->district_name;
        $data=array(
            'shop_name'=>$request->shop_name,
            'shop_owner_name'=>$request->shop_owner_name,
            'shop_owner_email'=>$request->shop_owner_email,
            'shop_slug' => Str::slug($request->shop_name, '-'),
            'shop_city'=>$request->shop_city,
            'district_id'=>$request->district_id,
            'district_name'=>$district_name,
            'shop_area'=>$request->shop_area,
            'shop_phone'=>$request->shop_phone,
            'shop_another_phone'=>$request->shop_another_phone,
            'open_time'=>$request->open_time,
            'close_time'=>$request->close_time,
            'status'=>$shop->status,
    );
     $slug=Str::slug($request->shop_name, '-');
    
      
    // update with owner photo
    	if ($request->owner_photo) {
            if (File::exists($request->old_photo)) {
                   unlink($request->old_photo);
              }
        
            $logo=$request->owner_photo;
            $photoname=$slug.'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(240,120)->save('storage/files/shop_owner_photo/'.$photoname); 
            $data['shop_owner_photo']='storage/files/shop_owner_photo/'.$photoname;
            
         
      
      }else{
        $data['shop_owner_photo']=$request->old_photo;
    
  }

 // update with shop photo
 if ($request->shop_photo) {
   
  if (File::exists($request->old_shop_photo)) {
         unlink($request->old_shop_photo);
    }
 
  $shopPhoto=$request->shop_photo;
  $photoname=$slug.'.'.$shopPhoto->getClientOriginalExtension();
  $shopPhoto->move('storage/files/shop_image/',$photoname);
  $data['shop_photo']='storage/files/shop_image/'.$photoname;
  $shop=Shop::find($id);
  $shop->update($data);
  $notification=array('message'=>'Shop update successfully!');
  return redirect()->route('shop.index')->with($notification);

}else{

$data['shop_image']=$request->old_shop_photo;
$shop=Shop::find($id);
$shop->update($data);
$notification=array('message'=>'Shop update successfully!');
return redirect()->route('shop.index')->with($notification);
}

    
    }

    // shop inactive method
    public function notstatus($id)
    {
        $shop=Shop::where('id',$id)->update(['status'=>0]);
        $shopname=Shop::where('id',$id)->first();

        $data=['name'=>$shopname->shop_owner_name];
        $user['to']=$shopname->shop_owner_email;

        // Mail::send('admin.category.shop.mail.accountDeactive',$data,function($message) use ($user){
        //     $message->to($user['to']);
        //     $message->subject('Account Deactivation');
        // });
        return response()->json('Shop Inactive successfully1');
    }

     // shop active method
     public function activestatus($id)
     {
         $shop=Shop::where('id',$id)->update(['status'=>1]);
         $shopname=Shop::where('id',$id)->first();

         $data=['name'=>$shopname->shop_owner_name];
         $user['to']=$shopname->shop_owner_email;

        //  Mail::send('admin.category.shop.mail.activeAccount',$data,function($message) use ($user){
        //      $message->to($user['to']);
        //      $message->subject('Account Activation');
        //  });
         return response()->json('Shop Active successfully1');
     }

    //  shop view

    function shopView($id){

        $shop=Shop::where('id',$id)->first();
        $close_time=$shop->close_time;
        return view('admin.category.shop.show',compact('shop'));

    }
// shop export
function shopExport(){
    return Excel::download(new shopExport,'shop.xlsx');

}
}
