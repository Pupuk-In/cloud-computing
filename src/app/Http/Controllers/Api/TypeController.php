<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    public function index()
    {
        $type = Type::all();

        return response()->json([
            "message" => "All types fetched successfully.",
            "type" => $type
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:types,name',
            'picture' => 'string',
        ]);

        $type = Type::create($request->all());

        return response()->json([
            "message" => "Type created successfully.",
            "type" => $type
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);

        $request->validate([
            'name' => 'string|required',
            Rule::unique('types', 'name')->ignore($type->id),
            'picture' => 'string',
        ]);

        $type->update($request->all());

        return response()->json([
            "message" => "Type updated successfully.",
            "type" => $type
        ], 200);
    }

    public function destroy(Request $id)
    {
        $type = Type::findOrFail($id);
        
        $type->delete();

        return response()->json([
            "message" => "Type deleted successfully.",
        ], 200);
    }
}
