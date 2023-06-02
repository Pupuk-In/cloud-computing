<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'profile_id',
        'item_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function picture()
    {
        return $this->hasManyThrough(ItemPicture::class, Item::class);
    }

    public function store()
    {
        return $this->hasManyThrough(Store::class, Item::class);
    }

    public function type()
    {
        return $this->hasManyThrough(ItemType::class, Item::class);
    }

    public function plant()
    {
        return $this->hasManyThrough(Plant::class, Item::class);
    }

    public function plantPart()
    {
        return $this->hasManyThrough(PlantPart::class, Item::class);
    }
}
