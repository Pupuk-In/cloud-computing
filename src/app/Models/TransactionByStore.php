<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionByStore extends Model
{
    use HasFactory;

    protected $table = 'transaction_by_stores';

    protected $fillable = [
        'transaction_id',
        'store_id',
        'invoice',
        'total',
        'transaction_status_id',
        'created_at',
        'updated_at'
    ];


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function transactionItem()
    {
        return $this->hasMany(TransactionItems::class);
    }

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class);
    }
}
