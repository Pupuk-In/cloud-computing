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
            "message" => "All plants fetched successfully.",
            "plant" => $plant
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:soils,name',
            'picture' => 'string',
        ]);

        $plant = Plant::create($request->all());

        return response()->json([
            "message" => "Plant created successfully.",
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
        ]);
        
        $plant->update($request->all());
        
        return response()->json([
            "message" => "Plant updated successfully.",
            "plant" => $plant
        ], 200);
    }

    public function destroy(Request $id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();

        return response()->json([
            "message" => "Plant deleted successfully."
        ], 200);
    }
}
