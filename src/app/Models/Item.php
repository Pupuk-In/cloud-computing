<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

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
        'plant_part_id',
        'store_id',
    ];
    

    // protected $table = 'items';
    // protected $dates = ['deleted_at'];

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

    public function type()
    {
        return $this->hasOne(Type::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Profile::class);
    }
}
