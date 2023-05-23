<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

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

    public function soil()
    {
        return $this->hasMany(Soil::class);
    }
}
