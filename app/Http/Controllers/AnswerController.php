<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function create(Request $request){

        $data = $request->validate([
            'content'=>'required|min:5|string',
            'question_id'=>'required|int'
        ]);
        $answer = new answer();
        $answer->content =  $request['content'];
        $answer->user_id = Auth::guard('api')->user()->id;
        $answer->question_id = $request['question_id'];
        $answer->save();

        return response(['answer'=>$answer]);
    }
    public function read(Request $request,$id){
        // error_log($request['question_id']);
        $answers = answer::where('question_id','=',$id)->get();
        return response(['answers'=>$answers]);
    }

    public function update(Request $request, $id)
    {
        $answer = answer::find($id);
        $answer->content = $request->content;
        $answer->save();
        return response(['answer'=>$answer]);
    }
    public function delete(Request $request, $id)
    {
        $answer = answer::find($id);
        $answer->delete();
        return response(['message'=>'answer deleted']);
    }
}
