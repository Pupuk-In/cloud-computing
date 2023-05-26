<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $store = Store::where('id', $request->id)->first();

        if(!$store){
            return response()->json([
                "message" => "Store not found."
            ], 404);
        }

        return response()->json([
            "message" => "Store details fetched successfully.",
            "store" => $store
        ], 200);
    }

    public function indexSelf()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        if(!$store){
            return response()->json([
                "message" => "Store not found."
            ], 404);
        }

        return response()->json([
            "message" => "Store details fetched successfully.",
            "store" => $store
        ], 200);
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $request->validate([
            'name' => 'string|required|unique:stores,name',
            'picture' => 'string',
            'address' => 'string|required',
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'description' => 'string',
            'rating' => 'float',
        ]);

        $request['profile_id'] = $profile->id;

        $request->validate([
            'profile_id' => 'unique:stores,profile_id'
        ]);

        $store = Store::create($request->all());

        return response()->json([
            "message" => "Store created successfully.",
            "store" => $store
        ], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $request->validate([
            'name' => 'string|required',
            Rule::unique('stores', 'name')->ignore($store->id),
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

        

        $store->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "message" => "Store updated successfully.",
            "store" => $store
        ], 200);
    }
}