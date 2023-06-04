<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'profile_id',
        'total',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
