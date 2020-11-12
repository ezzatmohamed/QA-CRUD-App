<?php

namespace App\Http\Middleware;

use Closure;
use App\question;
use App\User;

use Illuminate\Support\Facades\Auth;

class QuestionBelongsToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $question = question::find($request->id);
        if(!$question)
        {
            return response(['message'=>'question does not exist']);
        }
        if($question->user_id !=  Auth::guard('api')->user()->id)
        {
            return response(['message'=>'question does not belong to this user']);
        }
        return $next($request);
    }
}
