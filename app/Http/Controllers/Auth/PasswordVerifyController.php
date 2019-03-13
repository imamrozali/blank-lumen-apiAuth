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
        $pswReset = PasswordReset::where('token', $token)->firstOrFail();

        return response()->json($pswReset, 201);
    }
}
