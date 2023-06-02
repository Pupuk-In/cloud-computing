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

class WishlistController extends Controller
{
    public function index(){
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();
        $profile_id = $profile->id;

        $wishlist = QueryBuilder::for(Item::class)
            ->with([
                'picture',
                'store',
                'type',
                'plant',
                'plantPart',
                'wishlist'
                ])
            ->where('profile_id', $profile_id)
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
            "message" => "Wishlisted items fetched successfully.",
            "wishlist" => $wishlist
        ], 200);
    }

    public function store(Request $request){
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
