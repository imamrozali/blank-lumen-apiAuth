<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\UserVerification;
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
        $userVerification = UserVerification::where('token', $token)->firstOrFail();
        return response()->json($userVerification->token, 201);
    }
}
