<?php

namespace App\Http\Controllers\Auth\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        return response()->json($request->user(), 201);
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
            'username' => [
                'required',
                'string',
                'min:3',
                'max:15',
                'regex:/^([a-zA-Z_]+)(\d+)?$/',
                'regex:/^((?!('.env('AUTH_USERNAME_BLACKLIST').')).)*$/',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->update([
            'username' => $request['username']
        ]);

        return response()->json([
            'message' => 'Username updated.'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->user()->token()->delete();
        
        $user = $request->user();
        $user->delete();

        return response()->json([
            'message' => 'Account deleted.'
        ], 201);
    }
}
