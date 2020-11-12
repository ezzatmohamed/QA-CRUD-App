<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email'=>'required|string',
            'password' =>'required|string'
        ]);
        if(!Auth::attempt($credentials))
        {
            return response(['message'=>"invalid credentials"]);
        }

        $token = $user->createToken('token')->accessToken;
        return response(['user'=>Auth::user(),'token'=>$token ]);


    }
}

