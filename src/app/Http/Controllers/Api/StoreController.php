<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\PriceRangeFilter;

class StoreController extends Controller
{
    public function show(Request $request)
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

    public function showSelf()
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

    public function showCatalog(Request $request)
    {
        $store = Store::where('id', $request->id)->first();

        if(!$store){
            return response()->json([
                "message" => "Store not found."
            ], 404);
        }

        $catalog = QueryBuilder::for(Item::class)
            ->where('store_id', $store->id)
            ->with('picture', 'store', 'type', 'plant', 'plantPart')
            ->allowedFilters([
                    AllowedFilter::partial('name'),
                    AllowedFilter::exact('type', 'type.id'),
                    AllowedFilter::exact('plant', 'plant.id'),
                    AllowedFilter::exact('part', 'plantPart.id'),
                    AllowedFilter::custom('price', new PriceRangeFilter)
                ])
            ->defaultSort('created_at')
            ->allowedSorts('name', 'price', 'created_at')
            ->paginate(10)
            ->appends(request()->query());

        return response()->json([
            "message" => "Store catalogs fetched successfully.",
            "store" => $store,
            "catalog" => $catalog
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
        

        $store->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "message" => "Store updated successfully.",
            "store" => $store
        ], 200);
    }
}