<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionByStore;
use App\Models\TransactionItems;
use App\Models\TransactionStatus;
use App\Models\PaymentMethod;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $cart = Cart::where('profile_id', $profile->id)
            ->with(
                'cartItem',
                'cartItem.item',
                // 'cartItem.item.picture',
                // 'cartItem.item.store', 
            //     'cartItem.item.type',
            //     'cartItem.item.plant',
            //     'cartItem.item.plantPart'
                )
            ->first();
        
        $cartGroupByStore = Cart::where('carts.profile_id', $profile->id)
            ->join('cart_items as cartItem', 'cartItem.cart_id', '=', 'carts.id')
            ->join('items as item', 'item.id', '=', 'cartItem.item_id')
            ->join('stores as store', 'store.id', '=', 'item.store_id')
            ->groupBy('store.id')
            ->select('store.id as store_id', 'store.name as store_name', 'store.address as store_address', 'store.latitude as store_latitude', 'store.longitude as store_longitude')
            ->get();

        $request->validate([
            'recipient_name' => 'required',
            'recipient_phone' => 'required',
            'recipient_address' => 'required',
            'recipient_latitude' => 'required',
            'recipient_longitude' => 'required',
            'payment_method_id' => 'required',
        ]);
        
        $transaction = new Transaction([
            'recipient_name' => $request->recipient_name,
            'recipient_phone' => $request->recipient_phone,
            'recipient_address' => $request->recipient_address,
            'recipient_latitude' => $request->recipient_latitude,
            'recipient_longitude' => $request->recipient_longitude,
            'profile_id' => $profile->id,
            'payment_method_id' => $request->payment_method_id,
            'transaction_status_id' => 1,
        ]);

        $transaction->save();


        foreach($cartGroupByStore as $cartGrouped) {
            $cartGrouped = new TransactionByStore([
                'transaction_id' => $transaction->id,
                'store_id' => $cartGrouped->store_id,
                'invoice' => 'INV/'.date('y-m-d').'/'.$cartGrouped->store_id.'/'.$transaction->id.'/'.mt_rand(1000, 9999)
            ]);

            $cartGrouped->save();
        }

        foreach($cart['cart_item'] as $cartItem){
            $transactionItem = new TransactionItems([
                'transaction_by_store_id' => $cartItem->item->store_id,
                'item_id' => $cartItem->item_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->item->price,
                'subtotal' => $cartItem->item->price * $cartItem->quantity,
            ]);

            $transactionItem->save();
        }

        return response()->json([
            'message' => 'success',
            // 'transaction' => $transaction,
            // 'grouped by store' => $cartGroupByStore,
        ], 200);
    }
}
