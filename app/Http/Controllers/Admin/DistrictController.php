<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\District;
use\App\Models\Shop;
use DataTables;
use Illuminate\Support\Str;
use File;
use Image;
use DB;

class DistrictController extends Controller
{
    
    // show district
    public function index(Request $request)
    {
       if ($request->ajax()) {
    

            $district="";
            $query=District::latest();

            if ($request->status==0) {
                $query->where('status',0);
            }
            if ($request->status==1) {
                $query->where('status',1);
            }


            $district=$query->get();
            return DataTables::of($district)
            ->addIndexColumn()
            ->editColumn('status',function($row){
              if ($row->status==1) {
                  return ' <span class="badge badge-success">Active</span> ';
              }else{
                  return '<span class="badge badge-danger">Inactive</span>';
              }
          })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                        <a href="'.route('district.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }
        return view('admin.district.index');
    }

      //store method
      public function store(Request $request)
      {
        $validatedData = $request->validate([
            'district_name'=>'required|unique:districts|max:55',
         
        ]);
        
        $slug=Str::slug($request->district_name, '-');
        $district = District::create([
            'district_name'=>$request->district_name,
            'district_slug' => Str::slug($request->district_name, '-'),
        
        ]);
       // working with district photo
       $photo=$request->district_photo;
       $photoname=$slug.'.'.$photo->getClientOriginalExtension();
       $photo->move('storage/files/district_image/',$photoname);

       $district->district_photo='storage/files/district_image/'.$photoname;  
       $district->save();
        $notification=array('message'=>'District create successfully!');
         return redirect()->route('district.index')->with($notification);
      }

         //delete district
    public function delete($id)
    {
        $district=District::find($id);
        $photo=$district->district_photo;

    	if (File::exists($photo)) {
    		 unlink($photo);
    	}
         $district->delete();
         $notification=array('message'=>'District delete successfully!');
         return redirect()->route('district.index')->with($notification);

    }
    // edit district
    public function edit($id)
    {
        $district=District::where('id',$id)->first();
        return view('admin.district.edit',compact('district'));
    }
    // update district
    public function update(Request $request)
    {
        $id = $request->id;
        // validation
        $district=District::where('id',$id)->first();
        $this->validate($request, [
           'district_name' => "required|unique:districts,district_name,$district->id",
       ]);
        $data=array(
            'district_name'=>$request->district_name,
            'district_slug' => Str::slug($request->district_name, '-'),
            'status'=>$request->status,
          
    );
    $slug=Str::slug($request->district_name, '-');
    if ($request->district_photo) {
        if (File::exists($request->old_photo)) {
               unlink($request->old_photo);
          }
        $photo=$request->district_photo;
        $photoname=$slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(240,120)->save('storage/files/district_image/'.$photoname); 
        $data['district_photo']='storage/files/district_image/'.$photoname;	
        $district = District::find($id);
        $district->update($data);
        $notification=array('message'=>'District update successfully!');
         return redirect()->route('district.index')->with($notification);
    }else{
    $data['district_photo']=$request->old_photo;	
    $district = District::find($id);
    $district->update($data);
    $notification=array('message'=>'District update successfully!');
     return redirect()->route('district.index')->with($notification);
    }
    }

    // show district wish shop report chart
    function showShopReport(){
       $getShopDistrict=Shop::select('district_name',DB::raw('count(district_name) as count'))->groupBy('district_name')->get()->toArray();
        return view('admin.district.shop_chart',compact('getShopDistrict'));
    }
}
