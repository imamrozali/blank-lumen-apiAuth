<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
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
            'identifier' => 'required',
            'password'   => 'required'
        ]);

        // Validar usuario.
        $user = User::where('email', $request['identifier'])->orWhere('username', $request['identifier'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid identifier.'
            ], 422);
        }
        
        // Validar contraseña
        if (!Hash::check($request['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid password.'
            ], 422);
        }

        // Token
        $token = $user->createToken('Personal Access Token')->accessToken;
        
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer'
        ], 200);
    }
}
