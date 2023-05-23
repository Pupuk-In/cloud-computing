<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'picture',
        'description',
        'price',
        'stock',
        'sold',
        'rating',
        'relevance',
        'brand',
        'type_id',
        'store_id'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function plantParts()
    {
        return $this->hasMany(PlantPart::class);
    }

    public function plant()
    {
        return $this->hasMany(Plant::class);
    }
}
