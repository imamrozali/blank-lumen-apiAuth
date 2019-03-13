<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\User;
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
     * Actualización/Cambio de la contraseña.
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

        $pswReset = PasswordReset::where('token', $request['token'])->first();

        if (!$pswReset) {
            return response()->json([
                'message' => 'Invalid token.'
            ], 404);
        }

        $user = User::where('email', $pswReset->email)->first();

        $user->password = Hash::make($request['password']);
        $user->save();

        $pswReset->delete();

        return response()->json( [
            'message' => 'Password updated.'
        ], 201);
    }
}
