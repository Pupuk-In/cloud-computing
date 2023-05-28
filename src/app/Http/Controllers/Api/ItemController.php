<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Plant;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function indexActive()
    {
        $items = Item::get();

        $store = Store::where('id', $items->store_id)->first();

        return response()->json([
            "message" => "All active items fetched successfully.",
            "items" => $items
        ], 200);
    }

    public function indexDetail(Request $request)
    {
        $item = Item::where('id', $request->id)->first();

        $store = Store::select('id','name','address','rating')->where('id', $item->store_id)->first();

        $type = Type::select('id', 'name')->where('id', $item->type_id)->first();

        $item['store'] = $store;
        $item['type'] = $type;

        return response()->json([
            "message" => "Item details fetched successfully.",
            "item" => $item,
        ], 200);
    }

    public function indexInactive()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $item = Item::onlyTrashed()->where('store_id', $store->id)->get();

        return response()->json([
            "message" => "All inactive items fetched successfully.",
            "item" => $item
        ], 200);
    }

    public function indexAllItems()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $item = Item::withTrashed()->where('store_id', $store->id)->get();

        return response()->json([
            "message" => "All items fetched successfully.",
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
            "message" => "Item created successfully.",
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

        $item = Item::findOrFail($id);

        $item->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "message" => "Item updated successfully.",
            "item" => $item
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        if(!$item){
            return response()->json([
                "message" => "Item not found."
            ], 404);
        }

        $item->delete();

        return response()->json([
            "message" => "Item soft deleted successfully.",
            "item" => $item
        ], 200);
    }

    public function restoreSoftDelete(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $item = Item::onlyTrashed()->where('store_id', $store->id)->where('id', $id);

        $item->restore();

        return response()->json([
            "message" => "Item restored successfully.",
            "item" => $item
        ], 200);
    }

    public function PermDelete(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $item = Item::withTrashed()->where('store_id', $store->id)->where('id', $id);

        $item->forceDelete();

        return response()->json([
            "message" => "Item deleted permanently."
        ], 200);
    }
}
