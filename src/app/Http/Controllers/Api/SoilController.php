<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Soil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SoilController extends Controller
{
    public function index()
    {
        $soil = Soil::all();

        return response()->json([
            "soils" => $soil
        ], 200);
    }

    public function store(Request $request)
    {    
        $request->validate([
            'name' => 'string|required|unique:soils,name',
            'picture' => 'string',
            'description' => 'string',
            'nitrogen' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'phospor' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'calium' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'ph' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'temp' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'humidity' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);

        $soil = Soil::create($request->all());

        return response()->json([
            "soil" => $soil
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $soil = Soil::findOrFail($id);
        
        $request->validate([
            'name' => 'string|required',
            Rule::unique('soils', 'name')->ignore($soil->id),
            'picture' => 'string',
            'description' => 'string',
            'nitrogen' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'phospor' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'calium' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'ph' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'temp' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'humidity' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        
        $soil->update($request->all());
        
        return response()->json([
            "soil" => $soil
        ], 200);
    }

    public function destroy(Request $id)
    {
        $soil = Soil::findOrFail($id);
        
        $soil->delete();
        
        return response()->json([
            "soil" => $soil
        ], 200);
    }
}
