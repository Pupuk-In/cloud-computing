<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\PriceRangeFilter;
use Spatie\QueryBuilder\AllowedSort;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        // $wishlist = QueryBuilder::for(Item::class)
        //     ->join('items', 'wishlists.item_id', '=', 'items.id')
        //     ->where('profile_id', $profile->id)
        //     ->with(
        //         'item.picture',
        //         'item.store',
        //         'item.type',
        //         'item.plant',
        //         'item.plantPart'
        //         )
        //     ->allowedFilters([
        //             AllowedFilter::partial('name', 'item.name'),
        //             AllowedFilter::exact('type', 'item.type.id'),
        //             AllowedFilter::exact('plant', 'item.plant.id'),
        //             AllowedFilter::exact('part', 'item.plantPart.id'),
        //         ])
        //     ->defaultSort('created_at')
        //     ->allowedSorts([
        //         'created_at',
        //         AllowedSort::field('name', 'items.name'),
        //     ])
        //     ->paginate(10)
        //     ->appends(request()->query());

        // $wishlist = Wishlist::with('item', 'item.picture', 'item.store', 'item.type', 'item.plant', 'item.plantPart')->where('profile_id', $profile->id)->get();

        $wishlist = QueryBuilder::for(Item::class)
            ->join('wishlists', 'items.id', '=', 'wishlists.item_id')
            ->where('profile_id', $profile->id)
            ->select('items.*', 'wishlists.created_at as date_added')
            ->with('picture', 'store', 'type', 'plant', 'plantPart')
            ->allowedFilters([
                    AllowedFilter::partial('name'),
                    AllowedFilter::exact('type', 'type.id'),
                    AllowedFilter::exact('plant', 'plant.id'),
                    AllowedFilter::exact('part', 'plantPart.id'),
                    AllowedFilter::custom('price', new PriceRangeFilter)
                ])
            ->defaultSort('date_added')
            ->allowedSorts('name', 'price', 'date_added')
            ->paginate(10)
            ->appends(request()->query());

        return response()->json([
            "message" => "Wishlisted items fetched successfully.",
            "wishlist" => $wishlist
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $item = Item::where('id', $request->item_id)->first();

        if(!$item){
            return response()->json([
                "message" => "Item not found."
            ], 404);
        }

        $request->merge([
            'profile_id' => $profile->id
        ]);

        
        $request->validate([
            'profile_id' => 'required',
            'item_id' => 'required|unique:wishlists,item_id',
        ]);

        $wishlist = Wishlist::create($request->all());

        return response()->json([
            "message" => "Item added to wishlist successfully.",
            "wishlist" => $wishlist,
            "item" => $item
        ], 201);
    }
}
