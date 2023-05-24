<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_id',
        'item_id'
    ];

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }
    
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
