<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\User;
use App\UserVerification;

class RegisterVerifyController extends Controller
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
     * Validate the account of the registered user.
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke($token)
    {
        $userVerification = UserVerification::where('token', $token)->firstOrFail();

        $user = User::findOrFail($userVerification->user_id);
        $user->account_activated = true;
        $user->save();

        $userVerification->delete();

        return response()->json([
            'message' => 'Account verified.'
        ], 201);
    }
}