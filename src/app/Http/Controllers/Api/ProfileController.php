<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        return response()->json([
            "message" => "Profile fetched successfully.",
            "profile" => $profile
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'picture' => 'string',
            'birth_date' => 'date',
            'phone_number' => 'string',
            'address' => 'string',
            'latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $request['user_id'] = $request->user()->id;

        $profile = Profile::create($request->all());

        return response()->json([
            "message" => "Profile created successfully.",
            "profile" => $profile
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'picture' => 'string',
            'birth_date' => 'date',
            'phone_number' => 'string',
            'address' => 'string',
            'latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $user = Auth::user();

        // $profile = Profile::updateOrCreate(
        // ['user_id' => $user->id],
        // );

        $profile = Profile::where('user_id', $user->id)->first();

        $profile->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "message" => "Profile updated successfully.",
            "profile" => $profile
        ], 200);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
    }
}
