<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;
use\App\Models\Brand;


class BrandController extends Controller
{
  
    // show all brand
     function index(Request $request){
        if ($request->ajax()) {
    		$data=DB::table('brands')->get();
    		return DataTables::of($data)
    				->addIndexColumn()
    				->addColumn('action', function($row){
    					$actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('brand.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';
                       return $actionbtn; 	
    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}

    	return view('admin.category.brand.index');

     }
    //  brnad store method
    function store(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
         ]);
 
         $slug=Str::slug($request->brand_name, '-');
 
         $data=array();
         $data['brand_name']=$request->brand_name;
         $data['brand_slug']=Str::slug($request->brand_name, '-');
          //working with image
           $photo=$request->brand_logo;
           $photoname=$slug.'.'.$photo->getClientOriginalExtension();
           $photo->move('storage/files/brand/',$photoname);  
     
         $data['brand_logo']='storage/files/brand/'.$photoname;  
         DB::table('brands')->insert($data);
         $notification=array('message'=>'ChildCategory Inserted successfully!');
    return redirect()->route('brand.index')->with($notification);
    }
    // brand delete method
    public function delete($id)
    {
    	$data=Brand::where('id',$id)->first();
    	$image=$data->brand_logo;

    	if (File::exists($image)) {
    		 unlink($image);
    	}
        $brand=Brand::find($id);
        $brand->delete();
        $notification=array('message'=>'Brand Deleted successfully!');
        return redirect()->route('brand.index')->with($notification);
   
    }
    // brand edit method
    public function edit($id)
    {
    	$data=Brand::where('id',$id)->first();
    	return view('admin.category.brand.edit',compact('data'));
    }
    // brand update mehtod
    public function update(Request $request)
    {
        $id=$request->id;
            // validation
            $brand=Brand::where('id',$id)->first();
            $this->validate($request, [
               'brand_name' => "required|unique:brands,brand_name,$brand->id",
           ]);

    	$slug=Str::slug($request->brand_name, '-');
    	$data=array();
    	$data['brand_name']=$request->brand_name;
    	$data['brand_slug']=Str::slug($request->brand_name, '-');
    	if ($request->brand_logo) {
    		  if (File::exists($request->old_logo)) {
    		         unlink($request->old_logo);
    	        }
    		  $photo=$request->brand_logo;
    	      $photoname=$slug.'.'.$photo->getClientOriginalExtension();
    	      Image::make($photo)->resize(240,120)->save('storage/files/brand/'.$photoname); 
    	      $data['brand_logo']='storage/files/brand/'.$photoname;	
    	      DB::table('brands')->where('id',$request->id)->update($data);	
              $notification=array('message'=>'Brand update successfully!');
              return redirect()->route('brand.index')->with($notification);
    	}else{
		  $data['brand_logo']=$request->old_logo;	
	      DB::table('brands')->where('id',$request->id)->update($data);	
          $notification=array('message'=>'Brand update successfully!');
          return redirect()->route('brand.index')->with($notification);
    }
}
}