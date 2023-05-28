<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantSoil extends Model
{
    use HasFactory;

    protected $table = 'plant_soil';

    protected $fillable = [
        'plant_id',
        'soil_id'
    ];
}
