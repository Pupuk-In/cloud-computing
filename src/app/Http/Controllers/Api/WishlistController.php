<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $wishlistQuery = Item::join('wishlists', 'items.id', '=', 'wishlists.item_id')
            ->where('profile_id', $profile->id)
            ->select('items.*', 'wishlists.created_at as date_added')
            ->with('picture', 'store', 'type', 'plant', 'plantPart');

        // FILTER
        // by name (partial)
        if($request->search){
            $words = explode(' ', $request->search);
            $wishlistQuery->where(function ($query) use ($words) {
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
            $wishlistQuery->whereHas('type', function($query) use($request){
                $query->where('types.id', $request->type);
            });
        }
        // by relation plant (exact)
        if($request->plant){
            $wishlistQuery->whereHas('plant', function($query) use($request){
                $query->where('plants.id', $request->plant);
            });
        }
        // by relation plant (exact)
        if($request->part){
            $wishlistQuery->whereHas('plantPart', function($query) use($request){
                $query->where('plant_parts.id', $request->part);
            });
        }
        // by price (range)
        if ($request->input('price')) {
            $priceRange = explode('-', $request->input('price'));

            if (count($priceRange) === 2) {
                $lowerLimit = $priceRange[0];
                $upperLimit = $priceRange[1];

                $wishlistQuery->whereBetween('price', [$lowerLimit, $upperLimit]);
            }
        }

        // SORT
        if($request->sort){
            $sortColumn = $request->sort;
            $sortOrder = $request->order === 'desc' ? 'desc' : 'asc';
            $wishlistQuery->orderBy($sortColumn, $sortOrder);
        } else {
            $wishlistQuery->orderBy('created_at', 'desc');
        }

        // PAGINATE
        if($request->perPage){
            $wishlist = $wishlistQuery->paginate($request->perPage);
        } else {
            $wishlist = $wishlistQuery->paginate(10);
        }

        return response()->json([
            "message" => "Wishlisted items fetched successfully.",
            "wishlist" => $wishlist
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $item = Item::where('id', $id)->first();

        $wishlist = Wishlist::where('profile_id', $profile->id)->where('item_id', $item->id)->first();

        if(!$wishlist){
            return response()->json([
                "message" => "Item has not been wishlisted.",
                "wishlist" => false
            ], 404);
        }

        return response()->json([
            "message" => "Item has already been wishlisted.",
            "wishlist" => true
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
            'item_id' => 'required|unique:wishlists,item_id,NULL,id,profile_id,' . $profile->id,
        ]);

        $wishlist = Wishlist::create($request->all());

        return response()->json([
            "message" => "Item added to wishlist successfully.",
            "wishlist" => $wishlist,
            "item" => $item
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $wishlist = Wishlist::where('profile_id', $profile->id)->where('item_id', $id)->first();

        if(!$wishlist){
            return response()->json([
                "message" => "Item not found in wishlist."
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            "message" => "Item removed from wishlist successfully."
        ], 200);
    }
}
