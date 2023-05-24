<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class ItemCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // $profile = Profile::findOrFail($request->id);
        // $store = Store::findOrFail($request->id);

        $profile = Profile::where('user_id', $user->id)->first();

        $store = Store::where('profile_id', $profile->id)->first();

        if($profile->user_id != $user->id){
            if($store->profile_id != $profile->id){
                return response()->json([
                    "message" => "Unauthorized"
                ], 401);
            }
        }

        // return response()->json([
        //     "message" => "test middleware"
        // ], 200);
        return $next($request);
    }
}
