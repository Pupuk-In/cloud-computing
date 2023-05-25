<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

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
            "message" => "User logged in successfully",
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

    public function resetPassword(Request $request)
    {
        $input = $request->all();

        $user = Auth::user();

        $rules = array(
        'old_password' => 'required',
        'new_password' => 'required||string|min:6',
        'confirm_password' => 'required|string|same:new_password',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first());
        } else {
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                $arr = array("status" => 400, "message" => "Check your old password.");
            } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.");
            } else {
                User::where('id', $user->id)->update(['password' => Hash::make($input['new_password'])]);
                $arr = array("status" => 200, "message" => "Password updated successfully.");
            }
        }

        return response()->json([
            "message" => $arr['message']
        ], $arr['status']);
    }
}