<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPlantPart extends Model
{
    use HasFactory;

    protected $table = 'item_plant_part';

    protected $fillable = [
        'item_id',
        'plant_part_id'
    ];
}
