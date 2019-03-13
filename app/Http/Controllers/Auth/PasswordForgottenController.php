<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\PasswordForgotten;
use App\User;
use App\UserVerification;
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

        $user = User::where('email', $request['identifier'])
            ->orWhere('username', $request['identifier'])
            ->orWhere('email_two', $request['identifier'])
            ->orWhere('phone', $request['identifier'])
            ->firstOrFail();
        
        $token = new UserVerification([
            'user_id'        => $user->id,
            'password_reset' => true,
            'token'          => Str::random(60)
        ]);
        $token->save();

        Mail::to($user)->send(new PasswordForgotten($user));

        return response()->json([
            'message' => 'E-mail send.'
        ], 201);
    }
}
