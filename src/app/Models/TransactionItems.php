<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItems extends Model
{
    use HasFactory;

    protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_by_store_id',
        'item_id',
        'store_id',
        'quantity',
        'price',
        'subtotal',
        'created_at',
        'updated_at'
    ];

    public function transactionByStore()
    {
        return $this->belongsTo(TransactionByStore::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemHistory()
    {
        return $this->hasMany(ItemHistory::class, 'transaction_item_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
