<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\User;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
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
     * Update or Change password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed', // Usuario
            'token'    => 'required'                         // PasswordVerifyController (return)
        ]);

        $userVerification = UserVerification::where('token', $request['token'])->firstOrFail();

        $user           = User::findOrFail($userVerification->user_id);
        $user->password = Hash::make($request['password']);
        $user->save();

        $userVerification->delete();

        return response()->json([
            'message' => 'Password updated.'
        ], 201);
    }
}
