<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Plant;
use App\Models\Item;

class PageHomeController extends Controller
{
    public function indexTypeHome()
    {
        $type = Type::inRandomOrder()
                ->limit(10)
                ->get();

        return response()->json([
            "message" => "Fertilizer types fetched successfully.",
            "type" => $type
        ], 200);
    }

    public function indexPlantHome()
    {
        $plant = Plant::inRandomOrder()
                ->limit(5)
                ->get();

        return response()->json([
            "message" => "Plants fetched successfully.",
            "plant" => $plant
        ], 200);
    }
}
