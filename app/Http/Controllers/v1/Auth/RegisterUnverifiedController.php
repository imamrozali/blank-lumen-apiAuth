<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyAccount;
use App\User;
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
        //
    }
}
