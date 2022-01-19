<?php

namespace App\Http\Controllers\Shoper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use\App\Models\Question;
use\App\Models\Answer;
use Session;
use DB;

class ProductQuestion extends Controller
{
    
    // product queston by user
    function productQuestion(Request $request){

     
        if ($request->ajax()) {

            
            $shop=Session::get('shoper');
            $id=$shop->id;
            $imgurl='storage/files/products';
    
              
                $question="";
                $query=DB::table('questions')->where('questions.shop_id',$id)->leftJoin('users','questions.user_id','users.id')
                ->leftJoin('products','questions.product_id','products.id');;
       
                      if ($request->status==0) {
                        $query->where('questions.status',0);
                    }
                    if ($request->status==1) {
                        $query->where('questions.status',1);
                    }
                    
                        $question=$query->select('questions.*','users.FullName','products.name','products.thumbnail')->where('questions.shop_id',$id)
                           ->get();
                return DataTables::of($question)
                        ->addIndexColumn()
                   
                       ->editColumn('status',function($row){
                           if ($row->status==1) {
                               return ' <span class="badge badge-success">Reply</span>';
                           }else{
                               return '<span class="badge badge-danger">Pendding</span>';
                           }
                       })
                        ->addColumn('action', function($row){
                            $actionbtn='
                            <a href="#" class="btn btn-info btn-sm questionreply" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-comment-dots"></i></a>
                         
                            </a>
                         
                          ';
                           return $actionbtn;   
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);       
            }
         
            return view('shoper.product.product_question.index');
    }


    // question show modal
    function productQuestionShow($id){

       $data=Question::where('id',$id)->first();

       $answer=Answer::where('question_id',$id)->first();

        return view('shoper.product.product_question.show_question',compact('data','answer'));

    }

    // store answer

    function productAnswer(Request $request){


       $question_id=$request->question_id;

      $question=Question::where('id',$question_id)->first();

      $data=array(
        'question_id'=>$question_id,
        'user_id' => $question->user_id,
        'product_id' => $question->product_id,
        'shop_id'=>$question->shop_id,
        'answer'=>$request->answer,
         'answer_date'=>date('d , F Y'),

    
    );
   $answer=Answer::insert($data);
   $question=Question::where('id',$question_id)->update(['status'=>1]);
   $notification=array('message'=>'Answer Submitted Successfully!');
   return redirect()->route('shoper.product.question')->with($notification);
    }
}
