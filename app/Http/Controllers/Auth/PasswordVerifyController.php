<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * Verificación del token, éste recibido a través del correo electrónico.
     *
     * @param $token
	 * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke($token)
    {
        $pswReset = PasswordReset::where('token', $token)->first();

        if (!$pswReset) {
            return response()->json([
                'message' => 'Invalid token.'
            ], 404);
        }

        return response()->json($pswReset->token, 201);
    }
}
