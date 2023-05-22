<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'picture' => 'image',
            'birth_date' => 'date',
            'age' => 'integer',
            'address' => 'string',
            'phone_number' => 'string',
        ]);

        $request['user_id'] = $request->user()->id;

        $profile = Profile::create($request->all());

        return response()->json([
            "profile" => $profile
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'picture' => 'image',
            'birth_date' => 'date',
            'age' => 'integer',
            'address' => 'string',
            'phone_number' => 'string',
        ]);

        $user = Auth::user();

        // $profile = Profile::updateOrCreate(
        // ['user_id' => $user->id],
        // );

        $profile = Profile::where('user_id', $user->id)->first();

        $profile->update($request->all());

        // $profile->update($request->all());

        return response()->json([
            "profile" => $profile
        ], 200);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
    }
}
