<?php

namespace App\Http\Controllers\Auth\UserProfile;

use App\Http\Controllers\Controller;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $token)
    {
        $user             = $request->user();
        $userVerification = UserVerification::where('token', $token)->firstOrFail();

        if ($user->id != $userVerification->user_id) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }

        if ($userVerification->email) {
            $user->email = $userVerification->email;
        } else {
            $user->email = $userVerification->email_two;
        }
        $user->save();

        $userVerification->delete();

        return response()->json([
            'message' => 'E-mail verified and updated.'
        ], 201);
    }
}
