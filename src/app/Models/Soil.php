<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soil extends Model
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
        'nitrogen',
        'phospor',
        'calium',
        'ph',
        'temp',
        'humidity'
    ];

    public function plant()
    {
        return $this->belongsToMany(Plant::class);
    }
}
