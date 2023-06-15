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

class StoreOwnerController extends Controller
{
    public function indexTransaction()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $transactionGrouped = Transaction::join('transaction_by_stores as transactionByStore', 'transactionByStore.transaction_id', '=', 'transactions.id')
            ->join('transaction_statuses as transactionStatus', 'transactionStatus.id', '=', 'transactionByStore.transaction_status_id')
            ->groupBy('transactionStatus.id')
            ->select('transactionStatus.name as status')
            ->orderBy('transactionStatus.id', 'asc')
            ->get();

        $allTransaction = [];
        foreach($transactionGrouped as $transaction) {
            $transaction->transactions = Transaction::join('transaction_by_stores as transactionByStore', 'transactionByStore.transaction_id', '=', 'transactions.id')
                ->join('transaction_statuses as transactionStatus', 'transactionStatus.id', '=', 'transactionByStore.transaction_status_id')
                ->select('recipient_name', 'transactionByStore.*')
                ->where('transactionByStore.store_id', $store->id)
                ->where('transactionStatus.name', $transaction->status)
                ->orderBy('transactionByStore.id', 'desc')
                ->get();
            
            array_push($allTransaction, $transaction);
        }

        return response()->json([
            'message' => 'Transaction lists fetched successfully.',
            'transaction' => $allTransaction
        ], 200);
    }

    public function indexItemsTransactions()
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $transactionGrouped = Transaction::join('transaction_by_stores as transactionByStore', 'transactionByStore.transaction_id', '=', 'transactions.id')
            ->join('transaction_statuses as transactionStatus', 'transactionStatus.id', '=', 'transactionByStore.transaction_status_id')
            ->where('transactionStatus.id', '=', 1)
            ->groupBy('transactionStatus.id')
            ->select('transactionStatus.name as status')
            ->orderBy('transactionStatus.id', 'asc')
            ->get();

        $allTransaction = [];
        foreach($transactionGrouped as $transaction) {
            $transaction->transactions = Transaction::join('transaction_by_stores as transactionByStore', 'transactionByStore.transaction_id', '=', 'transactions.id')
                ->join('transaction_statuses as transactionStatus', 'transactionStatus.id', '=', 'transactionByStore.transaction_status_id')
                ->select('recipient_name', 'transactionByStore.*')
                ->where('transactionByStore.store_id', $store->id)
                ->where('transactionStatus.name', $transaction->status)
                ->orderBy('transactionByStore.id', 'desc')
                ->get();
            
            array_push($allTransaction, $transaction);
        }

        $item = Item::where('store_id', $store->id)->latest()->limit(2)->get();

        return response()->json([
            'message' => 'Latest items and transaction lists fetched successfully.',
            'transaction' => $allTransaction,
            'item' => $item
        ], 200);
    }

    public function showTransactionDetails(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $transactionByStore = TransactionByStore::where('id', $id)
            ->where('store_id', $store->id)
            ->with(['transactionStatus', 'transaction', 'transaction.paymentMethod', 'transactionItem' => function ($query) {
                $query->orderBy('id', 'desc');
            }, 'transactionItem.itemHistory',])
            ->first();

        return response()->json([
            'message' => 'Transaction details fetched successfully.',
            'transaction_detail' => $transactionByStore
        ], 200);
    }

    public function updateTransactionStatus(Request $request, $id)
    {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        $request->validate([
            'transaction_status_id' => 'required|integer',
        ]);
        
        $transactionByStore = TransactionByStore::findOrFail($id);
        $transactionByStore->update($request->all());

        $transactionByStore = TransactionByStore::where('id', $transactionByStore->id)
            ->where('store_id', $store->id)
            ->with(['transactionStatus', 'transaction', 'transaction.paymentMethod', 'transactionItem' => function ($query) {
                $query->orderBy('id', 'desc');
            }, 'transactionItem.itemHistory',])
            ->first();

        return response()->json([
            'message' => 'Transaction status updated successfully.',
            'transaction_detail' => $transactionByStore
        ], 200);
    }
}
