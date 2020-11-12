<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use Illuminate\Support\Facades\Auth;
class QuestionController extends Controller
{
    //

    public function create(Request $request){

        $data = $request->validate([
            'content'=>'required|min:5|string'
        ]);
        $question = new question();
        $question->content =  $request['content'];
        $question->user_id = Auth::guard('api')->user()->id;
        $question->save();

        return response(['question'=>$question]);
    }
    public function readMine(Request $request){

   
        $questions = question::where('user_id','=',Auth::guard('api')->user()->id)->get();
        
        return response(['questions'=>$questions]);
    }
    public function readAll(Request $request){
        $questions = question::all();
        return response(['questions'=> $questions]);
    }
    public function update(Request $request, $id)
    {
        $question = question::find($id);
        $question->content = $request->content;
        $question->save();
        return response(['question'=>$question]);
    }
    public function delete(Request $request, $id)
    {
        $question = question::find($id);
        $question->delete();
        return response(['message'=>'question deleted']);
    }
}
