<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Store;
use App\Models\Item;


class ItemEdit
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
        $profile = Profile::where('user_id', $user->id)->first();
        $store = Store::where('profile_id', $profile->id)->first();
        
        $item = Item::findOrFail($request->id);

        if ($item->store_id != $store->id) {
            return response()->json([
                "message" => "Unathorized"
            ], 401);
        }

        return $next($request);
    }
}
