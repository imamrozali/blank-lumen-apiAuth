<?php

namespace App\Http\Controllers\Auth\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // UserController@show
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // RegisterController
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
            'name' => [
                'string',
                'min:3',
                'max:15'
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore($user->id)
            ],
            'email'    => [
                'required',
                'email',
                'max:255',
                'confirmed',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'string|min:6'
        ]);

        if ($request['password'] != null) {
            $request['password'] = Hash::make($request['password']);
        } else {
            unset($request['password']);
        }

        $user->update($request->all());

        return response()->json( [
            'message' => 'Profile updated.'
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
        $user = $request->user();
        $user->delete();

        return response()->json( [
            'message' => 'Account deleted.'
        ], 201);
    }
}
