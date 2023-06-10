<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    use HasFactory;

    protected $table = 'item_histories';

    protected $fillable = [
        'transaction_item_id',
        'name',
        'picture',
        'description',
        'type',
        'plant',
        'plant_part',
        'price',
        'brand',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'picture' => 'array',
        'plant' => 'array',
        'plant_part' => 'array'
    ];

    public function transactionItem()
    {
        return $this->belongsToMany(TransactionItems::class);
    }
}
