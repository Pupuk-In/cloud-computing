<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'type_id',
        'price',
        'stock',
        'sold',
        'rating',
        'relevance',
        'brand',
        'store_id',
    ];

    public function priceRange(Builder $query, $start, $end): Builder
    {
        return $query->whereBetween('price', [$start, $end]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function plantPart()
    {
        return $this->belongsToMany(PlantPart::class);
    }

    public function plant()
    {
        return $this->belongsToMany(Plant::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function picture()
    {
        return $this->hasMany(ItemPicture::class, 'item_id', 'id');
    }
}
