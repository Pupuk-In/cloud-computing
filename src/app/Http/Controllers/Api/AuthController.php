<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                "message" => "Invalid email or password"
            ], 401);
        }

        $user = $request->user();

        $token = $user->createToken('auth-token')->plainTextToken;

        $user->access_token = $token;

        return response()->json([
            "user" => $user
        ], 200);
    }
    
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|alpha_dash|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        $profile = new Profile([
            'user_id' => $user->id,
        ]);

        $profile->save();

        return response()->json([
            "message" => "User registered successfully"
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        // $request->tokens()->delete();
        return response()->json([
            "message" => "User logged out successfully"
        ], 200);
    }

    public function index()
    {
        $user = Auth::user();

        return response()->json([
            "message" => "Authenticaed User Detected",
            "user" => $user
        ], 200);
    }
}