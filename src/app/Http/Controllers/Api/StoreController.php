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

    public function indexCatalog(Request $request)
    {
        $store = Store::where('id', $request->store_id)->first();

        if(!$store){
            return response()->json([
                "message" => "Store not found."
            ], 404);
        }


        $catalogQuery = Item::where('store_id', $store->id)->with('picture', 'store', 'type', 'plant', 'plantPart');

        // FILTER
        // by name (partial)
        if($request->search){
            $words = explode(' ', $request->search);
            $catalogQuery->where(function ($query) use ($words) {
                foreach ($words as $word) {
                    $query->orWhere('name', 'ILIKE', '%'.$word.'%')
                        ->orWhere('description', 'ILIKE', '%' . $word . '%')
                        ->orWhereHas('type', function($query) use($word){
                            $query->where('types.name', 'ILIKE', '%'.$word.'%');
                        })
                        ->orWhereHas('plant', function($query) use($word){
                            $query->where('plants.name', 'ILIKE', '%'.$word.'%');
                        });
                }
            });
        }
        // by relation type (exact)
        if($request->type){
            $catalogQuery->whereHas('type', function($query) use($request){
                $query->where('types.id', $request->type);
            });
        }
        // by relation plant (exact)
        if($request->plant){
            $catalogQuery->whereHas('plant', function($query) use($request){
                $query->where('plants.id', $request->plant);
            });
        }
        // by relation plant (exact)
        if($request->part){
            $catalogQuery->whereHas('plantPart', function($query) use($request){
                $query->where('plant_parts.id', $request->part);
            });
        }
        // by price (range)
        if ($request->input('price')) {
            $priceRange = explode('-', $request->input('price'));

            if (count($priceRange) === 2) {
                $lowerLimit = $priceRange[0];
                $upperLimit = $priceRange[1];

                $catalogQuery->whereBetween('price', [$lowerLimit, $upperLimit]);
            }
        }

        // SORT
        if($request->sort){
            $sortColumn = $request->sort;
            $sortOrder = $request->order === 'desc' ? 'desc' : 'asc';
            $catalogQuery->orderBy($sortColumn, $sortOrder);
        } else {
            $catalogQuery->orderBy('created_at', 'desc');
        }

        // PAGINATE
        if($request->perPage){
            $catalog = $catalogQuery->paginate($request->perPage);
        } else {
            $catalog = $catalogQuery->paginate(10);
        }

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