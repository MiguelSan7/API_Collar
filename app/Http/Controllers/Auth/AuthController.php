<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\auth\LoginRequest;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function register(Request $request){
        $validate= Validator::make($request->all(),[
            "nombre" => 'required|min:3|max:20',
            "apellidos" => 'required|min:3|max:20',
            "email" => 'required|string|email|unique:users|max:255',
            "password" => 'required|string|confirmed',
            "password_confirmation"=>'required|string'
        ]);

        if($validate->fails())
        {
            return response()->json(["errors"=>$validate->errors(),
            "msg"=>"Errores de validación"],422);
        }

        $user = new User;
        $user->nombre=$request->nombre;
        $user->apellidos=$request->apellidos;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();

        $token = JWTAuth::fromUser($user);
      

        return response()->json([
            "user" => $user,
            "token" => $token,
            "message" => "Successfully created user!"
        ], 201);
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        }catch(JWTException $e){
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json([
            'token' => $token,
            'message' => 'Successfully login!'
        ], 201);
    }
}
