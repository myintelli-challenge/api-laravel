<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function authLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if(!$token = JWTAuth::attempt($credentials)){
            
            return response()->json(['error'=>'Datos incorrectos'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    public function authRegister(Request $request){
        try{
            $validate = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:5|confirmed'
            ]);

            $user = User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password'])
            ]);

            return response()->json([
                'message' => 'Usuario creado',
                'user' => $user
            ], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }
}
