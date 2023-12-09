<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(request $request){
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string',
            'correo' => 'required|string|email|unique:users|max:255',
            'contraseña' => 'required|string|confirmed'
        ]);
        
    }
}
