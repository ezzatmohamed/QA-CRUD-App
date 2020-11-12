<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password' =>'required|string'
        ]);

        if(!Auth::attempt($credentials))
            return response(['message'=>"invalid credentials"]);

        $token = Auth::user()->createToken('token')->accessToken;
        return response(['user'=>Auth::user(),'token'=>$token ]);


    }
    public function signup(Request $request)
    {

        try{
            $credentials = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string'
            ]);


            $user = User::where('email','=',$request->email)->first();
            if($user)
                return response(['message'=>'user already exists!']);

            $data = request()->only('email','name','password');

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            return response(['message'=>'user created']);
        }
        catch(Exception $e)
        {
            return response(['message'=>'invalid inputs']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return response(['message'=>'logged out !']);
    }

}