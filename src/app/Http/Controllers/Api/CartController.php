<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $cart = Cart::where('profile_id', $profile->id)->with('cartItems', 'cartItems.item', 'cartItems.item.picture', 'cartItems.item.store', 'cartItems.item.type', 'cartItems.item.plant', 'cartItems.item.plantPart')->first();

        return response()->json([
            "message" => "Cart items fetched successfully.",
            "cart" => $cart,
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $cart = Cart::where('profile_id', $profile->id)->first();

        $item = Item::findOrFail($request->item_id)->with('picture', 'store', 'type', 'plant', 'plantPart')->first();

        $request->merge([
            'cart_id' => $cart->id,
            'price' => $item->price * $request->quantity
        ]);

        $request->validate([
            'cart_id' => 'required',
            'item_id' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $cartItem = CartItem::create($request->all());

        return response()->json([
            "message" => "Item added to cart successfully.",
            "cart" => $cartItem,
            "item" => $item,
        ], 201);
    }
}
