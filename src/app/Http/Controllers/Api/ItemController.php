<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Item;
use App\Models\ItemPlant;
use App\Models\ItemPlantPart;
use App\Models\Plant;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function indexActive()
    {
        $item = Item::get();

        $store = Store::where('id', $item->store_id)->first();

        $type = $item->type()->get();
        $plant = $item->plant()->get();
        $plantPart = $item->plantPart()->get();

        $item['store_id'] = $store;
        $item['type_id'] = $type;
        $item['plants'] = $plant;
        $item['plant_parts'] = $plantPart;

        return response()->json([
            "message" => "All active items fetched successfully.",
            "items" => $item
        ], 200);
    }

    public function indexDetail(Request $request)
    {
        $item = Item::where('id', $request->id)->first();

        $store = Store::where('id', $item->store_id)->first();

        $type = $item->type()->get();
        $plant = $item->plant()->get();
        $plantPart = $item->plantPart()->get();

        $item['store_id'] = $store;
        $item['type_id'] = $type;
        $item['plants'] = $plant;
        $item['plant_parts'] = $plantPart;

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

        $type = $item->type()->get();
        $plant = $item->plant()->get();
        $plantPart = $item->plantPart()->get();

        $item['store_id'] = $store;
        $item['type_id'] = $type;
        $item['plants'] = $plant;
        $item['plant_parts'] = $plantPart;

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

        $type = $item->type()->get();
        $plant = $item->plant()->get();
        $plantPart = $item->plantPart()->get();

        $item['store_id'] = $store;
        $item['type_id'] = $type;
        $item['plants'] = $plant;
        $item['plant_parts'] = $plantPart;

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
            'type_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'relevance' => 'integer',
            'brand' => 'string',
            'plant_id' => 'array|required',
            'plant_part_id' => 'array|required',
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

        foreach($request->plant_id as $plant_id){
            ItemPlant::create([
                'item_id' => $item->id,
                'plant_id' => $plant_id,
            ]);
        }

        foreach($request->plant_part_id as $plant_part_id){
            ItemPlantPart::create([
                'item_id' => $item->id,
                'plant_part_id' => $plant_part_id,
            ]);
        }

        $item['plant_id'] = $request->plant_id;
        $item['plant_part_id'] = $request->plant_part_id;

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
            'type_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'relevance' => 'integer',
            'brand' => 'string',
            'plant_id' => 'array|required',
            'plant_part_id' => 'array|required',
        ]);

        $item = Item::findOrFail($id);

        $item->update($request->all());

        
        ItemPlant::where('item_id', $item->id)->delete();
        foreach($request->plant_id as $plant_id){
            ItemPlant::create([
                'item_id' => $item->id,
                'plant_id' => $plant_id,
            ]);
        }

        ItemPlantPart::where('item_id', $item->id)->delete();
        foreach($request->plant_part_id as $plant_part_id){
            ItemPlantPart::create([
                'item_id' => $item->id,
                'plant_part_id' => $plant_part_id,
            ]);
        }

        $item['plant_id'] = $request->plant_id;
        $item['plant_part_id'] = $request->plant_part_id;

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
