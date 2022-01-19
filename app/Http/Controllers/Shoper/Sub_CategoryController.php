<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\SubCategories;
use\App\Models\Categories;
use\App\Models\Shop;
use Illuminate\Support\Str;
use File;
use Image;
use DataTables;
use Session;
use Illuminate\Validation\Rule;

class Sub_CategoryController extends Controller
{
    function index(Request $request){
        if ($request->ajax()) {
            $shop=Session::get('shoper');
            $id=$shop->id;

            $data="";
            $query=SubCategories::leftJoin('categories','sub_categories.category_id','categories.id')->where('sub_categories.shop_id',$id);
    		
            if ($request->category_id) {
                $query->where('sub_categories.category_id',$request->category_id);
            }

            $data=$query->select('categories.category_name','sub_categories.*')
            ->get();
          
    		return DataTables::of($data)
    				->addIndexColumn()
              
    				->addColumn('action', function($row){

    				    $actionbtn='
                      <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      <a href="'.  route('shoper.subcategory.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      </a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $shop=Session::get('shoper');
        $shop_id=$shop->id;
    $category=Categories::where('shop_id',$shop_id)->get();
  
    return view('shoper.category.sub_categories.index',compact('category'));

    }

    //subcategory store method
    function store(Request $request){
        $shop=Session::get('shoper');
        $shop_id=$shop->id;
        $category_id=$request->category_id;
        $validatedData = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name,NULL,id,category_id,' . $category_id,
       
        
         
        ]);
   
        $subcategory = SubCategories::create([
             'Subcategory_name' => $request->subcategory_name,
            'Subcat_slug' => Str::slug($request->subcategory_name, '-'),
            'category_id' => $request->category_id,
            'shop_id' =>$shop_id,
        
         ]);
        // working with image
        $photo=$request->subcategory_logo;
        $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
        $photo->move('storage/files/subcategory_logo/',$photoname);

        $subcategory->subcat_logo='storage/files/subcategory_logo/'.$photoname;  
        $subcategory->save();
         
        $notification=array('message'=>'SubCategory create successfully!');
         return redirect()->route('shoper.subcategory.index')->with($notification);
    } 


 // subcageory edit mehtod

 function edit($id){
    $shop=Session::get('shoper');
    $shop_id=$shop->id;
    $data=SubCategories::where('id',$id)->first();
    $category=Categories::where('shop_id',$shop_id)->get();;
    return view('shoper.category.sub_categories.edit',compact('data','category'));

}
   // subcageory update mehtod

   function update(Request $request){
    $id = $request->id;
    $shop=Session::get('shoper');
    $shop_id=$shop->id;
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
  
$data = array(
        'Subcategory_name' => $request->subcategory_name,
        'Subcat_slug' => Str::slug($request->subcategory_name, '-'),
        'category_id' => $request->category_id,
        'shop_id' =>$shop_id,
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
 return redirect()->route('shoper.subcategory.index')->with($notification);
}else{
$data['subcat_logo']=$request->old_logo;	
$subcatrgory = SubCategories::find($id);
$subcatrgory->update($data);
$notification=array('message'=>'SubCategory update successfully!');
return redirect()->route('shoper.subcategory.index')->with($notification);
}


    
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
         return redirect()->route('shoper.subcategory.index')->with($notification);
    }
}
