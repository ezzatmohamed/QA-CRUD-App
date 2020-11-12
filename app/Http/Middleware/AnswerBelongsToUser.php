<?php

namespace App\Http\Middleware;

use Closure;
use App\answer;
use App\User;

use Illuminate\Support\Facades\Auth;
class AnswerBelongsToUser
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
        $answer = answer::find($request->id);
        if(!$answer)
        {
            return response(['message'=>'answer does not exist']);
        }
        if($answer->user_id !=  Auth::guard('api')->user()->id)
        {
            return response(['message'=>'answer does not belong to this user']);
        }
        return $next($request);
    }
}
