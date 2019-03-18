<?php

namespace App\Http\Controllers\Auth\UserProfile;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyAccount;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserEmailController extends Controller
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
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response()->json($request->user()->email, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'email' => [
                'required',
                'email',
                'max:255',
                'confirmed',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->update($request['email']);

        $token = new UserVerification([
            'user_id' => $user->id,
            'email'   => $request['email'],
            'token'   => Str::random(60)
        ]);
        $token->save();
        
        Mail::to($user)->send(new VerifyEmail($token));

        return response()->json([
            'message' => 'E-mail updated.'
        ], 201);
    }
}
