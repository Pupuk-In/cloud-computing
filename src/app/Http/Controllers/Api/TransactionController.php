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
use Exception;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        try {
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

            $request->merge([
                'profile_id' => $profile->id,
                'payment_status_id' => 1,
            ]);
            
            $transaction = new Transaction([
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'recipient_address' => $request->recipient_address,
                'recipient_latitude' => $request->recipient_latitude,
                'recipient_longitude' => $request->recipient_longitude,
                'profile_id' => $request->profile_id,
                'payment_method_id' => $request->payment_method_id,
                'payment_status_id' => $request->payment_status_id,
            ]);

            $transaction->save();


            foreach($cartGroupByStore as $cartGrouped) {
                $cartGrouped = new TransactionByStore([
                    'transaction_id' => $transaction->id,
                    'store_id' => $cartGrouped->store_id,
                    'invoice' => 'INV/'.date('ymd').'/'.$cartGrouped->store_id.'/'.$transaction->id.'/'.mt_rand(1000, 9999)
                ]);
                
                $cartGrouped->save();
            }

            foreach($cart->cartItem as $cartItems){
                $transactionItem = new TransactionItems([
                    'transaction_by_store_id' => TransactionByStore::where('transaction_id', $transaction->id)->where('store_id', $cartItems->item->store_id)->first()->id,
                    'item_id' => $cartItems->item_id,
                    'store_id' => $cartItems->item->store_id,
                    'quantity' => $cartItems->quantity,
                    'price' => $cartItems->item->price,
                    'subtotal' => $cartItems->item->price * $cartItems->quantity,
                ]);

                $transactionItem->save();
            }

            $cartItem = CartItem::where('cart_id', $cart->id)->get();
            
            foreach($cartItem as $cartItems){
                $cartItems->delete();
            }

            return response()->json([
                'message' => 'Transaction success.',
                // 'cart_item' => $cart->cartItem,
                // 'profile_id' => $profile->id,
                // 'request' => $request->all(),
                // 'transaction' => $transaction,
                // 'grouped by store' => $cartGroupByStore,
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 404);
        }
    }
}
