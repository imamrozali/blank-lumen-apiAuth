<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\PasswordForgotten;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordForgottenController extends Controller
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
     * Generar el token y enviar correo electrónico.
     *
     * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'identifier' => 'required'
        ]);

        $user = User::where('email', $request['identifier'])->orWhere('username', $request['identifier'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid identifier.'
            ], 422);
        }
        
        $pswReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );

        if ($user && $pswReset) {
            Mail::to($user)->send(new PasswordForgotten($user, $pswReset));

            return response()->json([
                'message' => 'E-mail send.'
            ], 201);
        }
    }
}