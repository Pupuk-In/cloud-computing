<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlantPart;
use Illuminate\Validation\Rule;

class PlantPartController extends Controller
{
    public function index()
    {
        $plantpart = PlantPart::all();

        return response()->json([
            "message" => "All plant parts fetched successfully.",
            "plant_part" => $plantpart
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:plant_parts,name',
            'picture' => 'string',
        ]);

        $plantpart = PlantPart::create($request->all());

        return response()->json([
            "plant_part" => $plantpart
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $plantpart = PlantPart::findOrFail($id);

        $request->validate([
            'name' => 'string|required',
            Rule::unique('plant_parts', 'name')->ignore($plantpart->id),
            'picture' => 'string',
        ]);

        $plantpart->update($request->all());

        return response()->json([
            "plant_part" => $plantpart
        ], 200);
    }

    public function destroy(Request $id)
    {
        $plantpart = PlantPart::findOrFail($id);
        
        $plantpart->delete();

        return response()->json([
            "plant_part" => $plantpart
        ], 200);
    }
}
