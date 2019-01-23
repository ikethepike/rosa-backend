<?php

namespace Rosa\Http\Controllers\Api;

use Hash;
use Rosa\User;
use Illuminate\Http\Request;
use Rosa\Http\Controllers\Controller;
use Rosa\Http\Requests\User\LoginRequest;
use Rosa\Http\Requests\User\RegisterRequest;

class StudentController extends Controller
{
    private $success  = 200;
    private $frontend = 'rosa';

    public function __construct()
    {
        $this->frontend = env('FRONTEND_NAME') || 'rosa';
    }

    /**
     * Log a user in and set a token.
     *
     * @param LoginRequest $request
     *
     * @return json
     */
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

    /**
     * Register a student and send back token.
     *
     * @param RegisterRequest $request
     *
     * @return json
     */
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

    /**
     * Check whether a given email exists.
     *
     * @param Request $request
     *
     * @return int
     */
    public function exists(Request $request)
    {
        return (int) User::where('email', $request->email)->exists();
    }
}
