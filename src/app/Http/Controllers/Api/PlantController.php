<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plant;
use Illuminate\Validation\Rule;

class PlantController extends Controller
{
    public function index()
    {
        $plant = Plant::all();

        return response()->json([
            "plants" => $plant
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:soils,name',
            'picture' => 'string',
            'soil_id' => "integer|required|exists:soils,id",
        ]);

        $plant = Plant::create($request->all());

        return response()->json([
            "plant" => $plant
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);
        
        $request->validate([
            'name' => 'string|required',
            Rule::unique('plant', 'name')->ignore($plant->id),
            'picture' => 'string',
            'soil_id' => "integer|required|exists:soils,id",
        ]);
        
        $plant->update($request->all());
        
        return response()->json([
            "plant" => $plant
        ], 200);
    }

    public function destroy(Request $id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();

        return response()->json([
            "plant" => $plant
        ], 200);
    }
}
