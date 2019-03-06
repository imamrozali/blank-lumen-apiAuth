<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'username'           => $request['username'],
            'email'              => $request['email'],
            'password'           => Hash::make($request['password']),
            'verification_token' => Str::random(60)
        ]);

        $user->save();

        return response()->json( [
            'message' => 'Account created.'
        ], 201);
    }
}
