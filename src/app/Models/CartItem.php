<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity',
        'price'
    ];

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
