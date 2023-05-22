<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $request->validate([
            'name' => 'string|required',
            'picture' => 'string',
            'address' => 'string|required',
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'description' => 'string',
            'rating' => 'float',
        ]);

        $request['profile_id'] = $profile->id;

        $store = Store::create($request->all());

        return response()->json([
            "store" => $store
        ], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();


        $request->validate([
            'name' => 'string|required',
            'picture' => 'string',
            'address' => 'string|required',
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'description' => 'string',
            'rating' => 'float',
        ]);
        // $profile = Profile::updateOrCreate(
        // ['user_id' => $user->id],
        // );

        $store = Store::where('profile_id', $profile->id)->first();

        $store->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "store" => $store
        ], 200);
    }
}