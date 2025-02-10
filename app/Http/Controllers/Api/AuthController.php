<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
        $user  = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Succes',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function register(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'message' => 'Register Success',
            'data' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=> 'Logout Success',
        ]);
    }
}
