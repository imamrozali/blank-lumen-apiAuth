<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyAccount;
use Illuminate\Http\Request;
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
        $this->middleware('auth:api');
    }

    /**
     * Single Action Controller.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->account_activated == true) {
            return response()->json([
                'message' => 'This account has already been verified.'
            ], 404);
        }

        Mail::to($user)->send(new VerifyAccount($user));

        return response()->json([
            'message' => 'E-mail send.'
        ], 201);
    }
}
