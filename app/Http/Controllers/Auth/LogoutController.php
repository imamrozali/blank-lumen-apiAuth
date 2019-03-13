<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
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
        $request->user()->token()->delete();

        return response()->json([
            'message' => 'Successfully logged out.'
        ], 200);
    }
}
