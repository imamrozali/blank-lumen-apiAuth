<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
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
     */

    public function __invoke(Request $request)
    {
        return response()->json($request->user(), 201);
    }
}
