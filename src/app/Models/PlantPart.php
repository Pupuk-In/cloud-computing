<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantPart extends Model
{
    use HasFactory;

    protected $table = 'plant_parts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'picture'
    ];

    public function item()
    {
        return $this->belongsToMany(Item::class);
    }
}
