<?php

namespace App\Http\Middleware;

use Closure;

class MustVerifyAccount
{
    /**
     * Instantiate the Authenticate middleware to check if the user has logged in and then check if the user has
     * verified the account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (is_null($user)) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        } elseif ($user->account_activated == false) {
            return response()->json([
                'message' => 'Unverified account.'
            ], 401);
        }
        
        return $next($request);
    }
}
