<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate the request with library
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'string|in:user,admin',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create user
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ? $request->role : 'user',
        ]);
        //return user
        return response()->json([
            'user' => $user,
            'message' => 'User created successfully',
        ], 201);
    }

    public function login(Request $request)
    {
        //validate the request with library
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //check if user exists
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        //create token
        $token = JWTAuth::attempt($request->only('email', 'password'));
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
        //validate the credentials with library
        try {
            if(!$token=JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'invalid_credentials'], 401);

            }
            return response()->json([
                'message' => 'User logged in successfully',
                'token' => $token,
            ], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


    }

    //get user
    public function getUser()
    {
        $user= Auth::user();
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user,
        ],200);
    }

    //logout
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'message' => 'User logged out successfully',
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Failed to logout, please try again',
            ], 500);
        }
    }



}
