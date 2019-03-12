<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use Illuminate\Http\Request;

class PasswordVerifyController extends Controller
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

        return response()->json($pswReset, 201);
    }
}
