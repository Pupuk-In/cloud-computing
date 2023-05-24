<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $item = Item::where('id', $request->id)->first();

        if(!$item){
            return response()->json([
                "message" => "Item not found"
            ], 404);
        }

        return response()->json([
            "item" => $item
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $request->validate([
            'name' => 'string|required',
            'picture' => 'string',
            'description' => 'string',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'relevance' => 'integer',
            'brand' => 'string',
            'type_id' => 'integer',
            'plant_part_id' => 'integer',
        ]);

        $request['store_id'] = $store->id;
        $request['sold'] = 0;
        $request['rating'] = 0;

        $request->validate([
            'sold' => 'integer',
            'rating' => 'numeric|between:0,99.99',
            'store_id' => 'integer'
        ]);

        $item = Item::create($request->all());

        return response()->json([
            "Item" => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $request->validate([
            'name' => 'string|required',
            'picture' => 'string',
            'description' => 'string',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'rating' => 'float',
            'relevance' => 'integer',
            'brand' => 'string',
            'type_id' => 'integer',
            'plant_part_id' => 'integer',
        ]);
        // $profile = Profile::updateOrCreate(
        // ['user_id' => $user->id],
        // );

        $item = Item::where('id', $request->id)->first();

        $item->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "item" => $item
        ], 200);
    }
}
