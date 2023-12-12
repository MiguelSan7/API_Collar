<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate= Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|confirmed|min:8',
                'password_confirmation' => 'required|string',
            ]);
            if($validate->fails())
            {
                return response()->json(["errors"=>$validate->errors(),
                "msg"=>"Errores de validación"],422);
            }
            $user = new User([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $user->save();
    
            $token = JWTAuth::fromUser($user);
    
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Successfully created user!',
            ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
            if (auth()->check()) {
                $id = auth()->user()->id;
            } else {
                // Handle the case where the user is not authenticated
                return response()->json(['error' => 'unauthenticated'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'token' => $token,
            'message' => 'Successfully login!',
            'id'=>$id
        ], 201);
    }

    public function Home(Request $request, int $id)
    {
        $user=user::find($id);
        if($user)
        {
            return response()->json(
                [
                    "msg"=>"Persona encontrada!!",
                    "nombre"=>$user->nombre,
                    "apellidos"=>$user->apellidos,
                    "email"=>$user->email
                ],200);
        }

        return response()->json(
            [
                "msg"=>"Persona no encontrada"
            ],404);
    }
}