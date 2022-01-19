<?php

namespace App\Http\Controllers\Admin;
use\App\Models\Categories;
use\App\Models\Shop;
use\App\Models\SubCategories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use DB;
use DataTables;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    
    // show all categories
    function index(Request $request){
        if ($request->ajax()) {

            $data="";
            $query=Categories::leftJoin('shops','categories.shop_id','shops.id')
    		->select('shops.shop_name','categories.*');

            if ($request->shop_id) {
                $query->where('categories.shop_id',$request->shop_id);
            }

            $data=$query->get();
    		return DataTables::of($data)
    				->addIndexColumn()
                    ->editColumn('home_page',function($row){
                        if ($row->home_page==1) {
                            return ' <span class="badge badge-success">Active</span> ';
                        }else{
                            return ' <span class="badge badge-danger">Deactive</span>';
                        }
                    })
    				->addColumn('action', function($row){

    				    $actionbtn='
                      <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      <a href="'. route('category.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      </a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action','home_page'])
    				->make(true);		
    	}
     $shop=Shop::where('status',1)->get();
        return view('admin.category.category.index',compact('shop'));

      
    }

    // category store method
    function store(Request $request){
    $shop_id=$request->shop_id;
   
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories,category_name,NULL,id,shop_id,' . $shop_id,
 
         
        ]);
     
        $category = Categories::create([
            'shop_id'=>$request->shop_id,
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
            'home_page'=>$request->home_page,
        
        ]);
       
        // working with category logo
        $photo=$request->category_logo;
        $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
        $photo->move('storage/files/category_logo/',$photoname);

        $category->category_logo='storage/files/category_logo/'.$photoname;  
        $category->save();
            // working with category thumbnail
            $photo=$request->category_thumbnail;
            $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo->move('storage/files/category_thumbnail/',$photoname);

            $category->category_thumbnail='storage/files/category_thumbnail/'.$photoname;  
            $category->save();


        $notification=array('message'=>'Category create successfully!');
        return redirect()->route('category.index')->with($notification);
    }


    // category edit method
    function edit($id){

        $data=Categories::where('id',$id)->first();
        $shop=Shop::where('status',1)->get();

        return view('admin.category.category.edit',compact('data','shop'));


    }

    // category update mehtod
    public function update(Request $request)
    {
        $id=$request->id;
        $shop_id=$request->shop_id;
            // validation
            $category=Categories::where('id',$id)->first();
            $this->validate($request, [
                'category_name' =>  [
                    'required', 
                    Rule::unique('categories')
                    ->ignore($category->id)
                           ->where('shop_id', $shop_id)
                ],
               
           ]);

    	$slug=Str::slug($request->category_name, '-');
    	$data=array(
            'shop_id'=>$request->shop_id,
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
            'home_page'=>$request->home_page,
        
        );


    //     // update with category logo
    	if ($request->category_logo) {
    		  if (File::exists($request->old_logo)) {
    		         unlink($request->old_logo);
    	        }
             
            //    category logo
    		  $logo=$request->category_logo;
    	      $photoname=$slug.'.'.$logo->getClientOriginalExtension();
    	      Image::make($logo)->resize(240,120)->save('storage/files/category_logo/'.$photoname); 
    	      $data['category_logo']='storage/files/category_logo/'.$photoname;
              
           
        
    	}else{
		  $data['category_logo']=$request->old_logo;
      
    }
  
   // update with category thumbnail
   if ($request->category_thumbnail) {
     
    if (File::exists($request->old_thumbnail)) {
           unlink($request->old_thumbnail);
      }
   
  //    category thumbnail
    $thumbnail=$request->category_thumbnail;
    $photoname=$slug.'.'.$thumbnail->getClientOriginalExtension();
    $thumbnail->move('storage/files/category_thumbnail/',$photoname);
    $data['category_thumbnail']='storage/files/category_thumbnail/'.$photoname;
  
    $category->update($data);
    $notification=array('message'=>'Category update successfully!');
    return redirect()->route('category.index')->with($notification);

}else{
  
$data['category_thumbnail']=$request->old_thumbnail;
$category->update($data);
$notification=array('message'=>'Category update successfully!');
return redirect()->route('category.index')->with($notification);
}


   }
    // category delete method
    function delete($id){
        $Catregory=Categories::find($id);
        $image=$Catregory->category_logo;
        $thumbnail=$Catregory->category_thumbnail;

    	if (File::exists($image)) {
    		 unlink($image);
    	}
        if (File::exists($thumbnail)) {
            unlink($thumbnail);
       }
         $Catregory->delete();
         $notification=array('message'=>'Category delete successfully!');
         return redirect()->route('category.index')->with($notification);
    }
     

          //get category for create subcategory
    public function GetCategory($id)  //shop_id
    {
        $data=Categories::where('shop_id',$id)->get();
        return response()->json($data);
    }

   //get subcategory
    public function GetSubCategory($id){
        $data=SubCategories::where('category_id',$id)->get();
        return response()->json($data);
    }

}
