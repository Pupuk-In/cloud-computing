<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WishlistController extends Controller
{
    public function index(){
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $wishlist = Wishlist::with('item')->where('profile_id', $profile->id)->get();

        return response()->json([
            "message" => "Wishlist items fetched successfully.",
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
