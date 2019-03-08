<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

class VerifyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Single Action Controller.
     *
     * @param $token
	 * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid token.'
            ], 404);
        }

        $user->account_verified   = true;
        $user->verification_token = null;

        $user->save();

        return response()->json( [
            'message' => 'Account verified.'
        ], 201);
    }
}