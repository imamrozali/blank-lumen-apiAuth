<?php

namespace App\Http\Controllers\v1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     */

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:3|max:15|unique:users',
            'email'    => 'required|email|max:255|confirmed|unique:users',
            'password' => 'required|string|min:6',
        ]);

        
    }
}
