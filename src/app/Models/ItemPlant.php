<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPlant extends Model
{
    use HasFactory;

    protected $table = 'item_plant';

    protected $fillable = [
        'item_id',
        'plant_id'
    ];
}
