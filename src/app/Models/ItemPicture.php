<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPicture extends Model
{
    use HasFactory;

    protected $table = 'item_pictures';

    protected $fillable = [
        'item_id',
        'picture'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
