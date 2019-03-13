<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyAccount;
use App\User;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:3|max:15|unique:users',
            'email'    => 'required|email|max:255|confirmed|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = new User([
            'username' => $request['username'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->save();

        $token = new UserVerification([
            'user_id' => $user->id,
            'email'   => $user->email,
            'token'   => Str::random(60)
        ]);
        $token->save();

        Mail::to($user)->send(new VerifyAccount($user));

        return response()->json( [
            'message' => 'Account created. Please verify it via email.'
        ], 201);
    }
}
