<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Item;
use App\Models\ItemPicture;
use App\Models\ItemPlant;
use App\Models\ItemPlantPart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ItemController extends Controller
{
    public function indexActive()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();
        
        $item = Item::with('picture', 'store', 'type', 'plant', 'plantPart')->where('store_id', $store->id)->get();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'data'    => $item
            ], 200);
        }

        // $type = $items->type()->get();
        // $plant = $items->plant()->get();
        // $plantPart = $items->plantPart()->get();

        // $items['store_id'] = $store;
        // $items['type_id'] = $type;
        // $items['plant_id'] = $plant;
        // $items['plant_part_id'] = $plantPart;

        // foreach($item as $items){
        //     $type = $items->type()->get();
        //     $plant = $items->plant()->get();
        //     $plantPart = $items->plantPart()->get();

        //     $items['store_id'] = $store;
        //     $items['type_id'] = $type;
        //     $items['plant_id'] = $plant;
        //     $items['plant_part_id'] = $plantPart;

        //     $final[] = $item;
        // }

        // $items = Item::with('plant') ->where('store_id', $store->id)->get();

        return response()->json([
            "message" => "All active items fetched successfully.",
            "item" => $item
        ], 200);
    }

    public function indexInactive()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $item = Item::with('picture', 'store', 'type', 'plant', 'plantPart')->onlyTrashed()->where('store_id', $store->id)->get();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'data'    => $item
            ], 200);
        }

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

        $item = Item::withTrashed()->with('picture', 'store', 'type', 'plant', 'plantPart')->where('store_id', $store->id)->get();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'data'    => $item
            ], 200);
        }

        return response()->json([
            "message" => "All items fetched successfully.",
            "item" => $item
        ], 200);
    }

    public function show(Request $request)
    {
        $item = Item::with('picture', 'store', 'type', 'plant', 'plantPart')->where('id', $request->id)->first();

        if (!$item) {
            return response()->json([
                'message' => 'Item not found.',
                'data'    => $item
            ], 404);
        }

        return response()->json([
            "message" => "Item details fetched successfully.",
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
            'picture' => 'array',
            'description' => 'string',
            'type_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'relevance' => 'string',
            'brand' => 'string',
            'plant_id' => 'array',
            'plant_part_id' => 'array',
        ]);

        $request['store_id'] = $store->id;
        $request['sold'] = 0;
        $request['rating'] = 0;

        $request->validate([
            'sold' => 'integer',
            'rating' => 'numeric|between:0,99.99',
            'store_id' => 'integer'
        ]);

        // DB::beginTransaction();
        // try{
            

        // } catch(Exception $e) {
        //     DB::rollback();

        //     return response()->json([
        //         "message" => $e->getMessage()
        //     ], 400);
        // }
        
        $item = Item::create($request->all());

        if($request->picture != null){
            foreach($request->picture as $picture){
                ItemPicture::create([
                    'item_id' => $item->id,
                    'picture' => $picture,
                ]);
            }
        }

        if($request->plant_id !=null){
            foreach($request->plant_id as $plant_id){
                ItemPlant::create([
                    'item_id' => $item->id,
                    'plant_id' => $plant_id,
                ]);
            }
        }
        
        if($request->plant_part_id !=null){
            foreach($request->plant_part_id as $plant_part_id){
                ItemPlantPart::create([
                    'item_id' => $item->id,
                    'plant_part_id' => $plant_part_id,
                ]);
            }
        }

        $item = Item::with('picture', 'store', 'type', 'plant', 'plantPart')->find($item->id);

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
            'picture' => 'array',
            'description' => 'string',
            'type_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'relevance' => 'string',
            'brand' => 'string',
            'plant_id' => 'array|required',
            'plant_part_id' => 'array|required',
        ]);

        $item = Item::findOrFail($id);

        $item->update($request->all());

        ItemPicture::where('item_id', $item->id)->delete();
        foreach($request->picture as $picture){
            ItemPicture::create([
                'item_id' => $item->id,
                'picture' => $picture,
            ]);
        }
        
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

        $item = Item::with('picture', 'store', 'type', 'plant', 'plantPart')->find($item->id);

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

        $item = Item::withTrashed()->with('picture', 'store', 'type', 'plant', 'plantPart')->find($item->id);

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

        if(!$item){
            return response()->json([
                "message" => "Item not found."
            ], 404);
        }

        $item->restore();

        $item = Item::withTrashed()->with('picture', 'store', 'type', 'plant', 'plantPart')->find($item->id);

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

        if(!$item){
            return response()->json([
                "message" => "Item not found."
            ], 404);
        }

        $item->forceDelete();

        return response()->json([
            "message" => "Item deleted permanently."
        ], 200);
    }
}
