<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\SubCategories;
use\App\Models\Categories;
use\App\Models\Shop;
use Illuminate\Support\Str;
use File;
use Image;
use DataTables;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
  

    function index(Request $request){
        if ($request->ajax()) {

            $data="";
            $query=SubCategories::leftJoin('shops','sub_categories.shop_id','shops.id')->
            leftJoin('categories','sub_categories.category_id','categories.id');
    		
            if ($request->shop_id) {
                $query->where('sub_categories.shop_id',$request->shop_id);
            }
            if ($request->category_id) {
                $query->where('sub_categories.category_id',$request->category_id);
            }

            $data=$query->select('shops.shop_name','categories.category_name','sub_categories.*')
            ->get();
          
    		return DataTables::of($data)
    				->addIndexColumn()
              
    				->addColumn('action', function($row){

    				    $actionbtn='
                      <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      <a href="'.  route('subcategory.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      </a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}

    $category=Categories::all();
    $shop=Shop::where('status',1)->get();
    return view('admin.category.subcategory.index',compact('category','shop'));

    }

    // store method
    function store(Request $request){
        $category_id=$request->category_id;
        $validatedData = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name,NULL,id,category_id,' . $category_id,
       
        
         
        ]);

 
     $slug=Str::slug($request->subcategory_name, '-');
   
        $subcategory = SubCategories::create([
             'Subcategory_name' => $request->subcategory_name,
            'Subcat_slug' => Str::slug($request->subcategory_name, '-'),
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
        
         ]);
        // working with image
        $photo=$request->subcategory_logo;
        $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
        $photo->move('storage/files/subcategory_logo/',$photoname);

        $subcategory->subcat_logo='storage/files/subcategory_logo/'.$photoname;  
        $subcategory->save();
         
        $notification=array('message'=>'SubCategory create successfully!');
         return redirect()->route('subcategory.index')->with($notification);
    }

     // subcategory delete method
     function delete($id){
        $subCatregory=SubCategories::find($id);
        $image=$subCatregory->subcat_logo;

    	if (File::exists($image)) {
    		 unlink($image);
    	}
         $subCatregory->delete();
         $notification=array('message'=>'SubCategory delete successfully!');
         return redirect()->route('subcategory.index')->with($notification);
    }

    // subcageory edit mehtod

    function edit($id){
        $data=SubCategories::where('id',$id)->first();
        $shop_id=$data->shop_id;
        $category=Categories::where('shop_id',$shop_id)->get();;
        $shop=Shop::where('status',1)->get();
        return view('admin.category.subcategory.edit',compact('data','category','shop'));

    }
     // subcageory update mehtod

     function update(Request $request){
        $id = $request->id;
        // validation
        $subcatrgory=SubCategories::where('id',$id)->first();
        $this->validate($request, [
            'subcategory_name' =>  [
                'required', 
                Rule::unique('sub_categories')
                ->ignore($subcatrgory->id)
                       ->where('category_id',$request->category_id)
            ],
           
    
       ]);
       $slug=Str::slug($request->subcategory_name, '-');
   $data = array(
            'Subcategory_name' => $request->subcategory_name,
            'Subcat_slug' => Str::slug($request->subcategory_name, '-'),
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
   );
   if ($request->subcategory_logo) {
    if (File::exists($request->old_logo)) {
           unlink($request->old_logo);
      }
    $photo=$request->subcategory_logo;
    $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
    Image::make($photo)->resize(240,120)->save('storage/files/subcategory_logo/'.$photoname); 
    $data['subcat_logo']='storage/files/subcategory_logo/'.$photoname;	
    $subcatrgory = SubCategories::find($id);
    $subcatrgory->update($data);
    $notification=array('message'=>'SubCategory update successfully!');
     return redirect()->route('subcategory.index')->with($notification);
}else{
$data['subcat_logo']=$request->old_logo;	
$subcatrgory = SubCategories::find($id);
$subcatrgory->update($data);
$notification=array('message'=>'SubCategory update successfully!');
 return redirect()->route('subcategory.index')->with($notification);
}

 
        
    }
    
}
