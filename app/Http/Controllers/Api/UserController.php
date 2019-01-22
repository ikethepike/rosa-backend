<?php

namespace Rosa\Http\Controllers\Api;

use Hash;
use Rosa\User;
use Rosa\Http\Controllers\Controller;
use Rosa\Http\Requests\User\LoginRequest;
use Rosa\Http\Requests\User\RegisterRequest;

class UserController extends Controller
{
    private $success  = 200;
    private $frontend = 'rosa';

    public function __construct()
    {
        $this->frontend = env('FRONTEND_NAME') || 'rosa';
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->all())) {
            return response()->json([
                    'user'  => auth()->user(),
                    'token' => auth()->user()->createToken($this->frontend)->accessToken,
                ],
                200
            );
        }

        return abort(401);
    }

    public function register(RegisterRequest $request)
    {
        $register           = collect($request->all());
        $register->password = Hash::make($request->password);
        $register->student  = true;
        $user               = User::create($register);

        return response()->json([
            'user'  => $user,
            'token' => $user->createToken($this->frontend)->accessToken,
        ], 200);
    }
}
