<?php

namespace App\Http\Controllers\Auth\UserProfile;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyEmail;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        $request->request->add([
            'current_email' => $user->email,
            'email_two'     => $user->email_two
        ]);

        $this->validate($request, [
            'email' => [
                'required',
                'email',
                'max:255',
                'different:current_email',
                'different:email_two',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $token = UserVerification::updateOrCreate(
            ['user_id' => $user->id, 'email_two' => null],
            ['email' => $request['email'], 'token' => Str::random(60)]
        );
        
        Mail::to($request['email'])->send(new VerifyEmail($token));

        return response()->json([
            'message' => 'E-mail send.'
        ], 201);
    }
}
