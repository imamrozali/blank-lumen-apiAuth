<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterUnverifiedController extends Controller
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
	 * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke()
    {
        $user = Auth::user();

        if ($user->account_verified == true) {
            return response()->json([
                'message' => 'This account has already been verified.'
            ], 404);
        }

        Mail::to($user)->send(new VerifyAccount($user));

        return response()->json( [
            'message' => 'E-mail send.'
        ], 201);
    }
}
