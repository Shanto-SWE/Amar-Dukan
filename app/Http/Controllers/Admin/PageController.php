<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\Page;
use Illuminate\Support\Str;


class PageController extends Controller
{
    
        //all page show method
        public function index()
        {
            $page=Page::latest()->get();
            return view('admin.setting.pages.index',compact('page'));
        }
        
    //page create form
    public function create()
    {
        return view('admin.setting.pages.create');
    }
      //page store
      public function store(Request $request)
      {
          $data=array(
          'page_position'=>$request->page_position,
          'page_name'=>$request->page_name,
          'page_slug'=>Str::slug($request->page_name, '-'),
          'page_title'=>$request->page_title,
          'page_description'=>$request->page_description,
      );
          $page=Page::insert($data);
          $notification=array('message'=>'Page create successfully!');
          return redirect()->route('page.index')->with($notification);
  
      }
     //page delete
    public function delete($id)
    {
       $page=Page::where('id',$id)->delete();
       $notification=array('message'=>'Page delete successfully!');
        return redirect()->back()->with($notification);
    }
        //page edit
        public function edit($id)
        {
            $page=Page::where('id',$id)->first();
            return view('admin.setting.pages.edit',compact('page'));
        }
    
    
        //page update
        public function update(Request $request,$id)
        {
            $data=array(
                'page_position'=>$request->page_position,
                'page_name'=>$request->page_name,
                'page_slug'=>Str::slug($request->page_name, '-'),
                'page_title'=>$request->page_title,
                'page_description'=>$request->page_description,
            );
            $page=Page::where('id',$id)->update($data);
            $notification=array('message'=>'Page update successfully!');
            return redirect()->route('page.index')->with($notification);
        }

  
}
