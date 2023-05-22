<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfiles
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
        // $currentUser = Auth::user();
        // $profile = Profile::findOrFail($request->id);

        // if($profile->user_id != $currentUser->id){
        //     return response()->json([
        //         "message" => "Unauthorized"
        //     ], 401);
        // }
        
        return $next($request);
    }
}
