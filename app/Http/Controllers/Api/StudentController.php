<?php

namespace Rosa\Http\Controllers\Api;

use Hash;
use Rosa\User;
use Rosa\Week;
use Carbon\Carbon;
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
                    'user'  => auth()->user()->load('attendance'),
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
        $user               = User::create($register->toArray());

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
        return User::where('email', $request->email)->first();
    }

    public function markAttendance(Request $request)
    {
        $date = new Carbon();
        $user = $request->user();
        if ($user->attendedWeek) {
            return $user;
        }

        // Update attendance
        $user->attendance()->attach(Week::current());

        $user->score += 40;
        $user->save();

        return $user;
    }
}
