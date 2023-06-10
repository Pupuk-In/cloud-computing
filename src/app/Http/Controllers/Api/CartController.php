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

        $cart = Cart::where('profile_id', $profile->id)
            ->with(['cartItem' => function ($query) {
                $query->orderBy('id', 'desc');
            },'cartItem.item', 'cartItem.item.picture', 'cartItem.item.store', 'cartItem.item.type', 'cartItem.item.plant', 'cartItem.item.plantPart'])
            ->first();

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

        $item = Item::where('id', $request->item_id)->first();

        $request->merge([
            'cart_id' => $cart->id,
            'price' => ($request->quantity) * ($item->price)
        ]);

        $request->validate([
            'cart_id' => 'required',
            'item_id' => 'required|unique:cart_items,item_id,NULL,id,cart_id,' . $cart->id,
            'quantity' => 'required',
            'price' => 'required'
        ]);


        // $cartItem = new CartItem([
        //     'cart_id' => $request->cart_id,
        //     'item_id' => $request->item_id,
        //     'quantity' => $request->quantity,
        // ]);

        $cartItem = CartItem::create($request->all());

        $cartItem = CartItem::with('item')->find($cartItem->id);

        return response()->json([
            "message" => "Item added to cart successfully.",
            "cart" => $cartItem
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $cart = Cart::where('profile_id', $profile->id)->first();

        $cartItem = CartItem::where('cart_id', $cart->id)->where('id', $id)->first();

        $item = Item::where('id', $cartItem->item_id)->first();

        $request->merge([
            'price' => ($request->quantity) * ($item->price)
        ]);

        $request->validate([
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $cartItem->update($request->all());

        $cartItem = CartItem::where('id', $id)
            ->with('item')
            ->first();

        return response()->json([
            "message" => "Item updated successfully.",
            "cart" => $cartItem
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $cart = Cart::where('profile_id', $profile->id)->first();

        $cartItem = CartItem::where('cart_id', $cart->id)->where('id', $id)->first();

        $cartItem->delete();

        return response()->json([
            "message" => "Item deleted from cart successfully.",
        ], 200);
    }
}
