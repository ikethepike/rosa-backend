<?php

namespace Rosa\Http\Controllers;

use Hash;
use Rosa\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Rosa\Http\Requests\User\LoginRequest;
use Rosa\Http\Requests\User\RegisterRequest;

class UserController extends Controller
{
    public function exists(Request $request)
    {
        return (int) User::where('email', $request->email)->exists();
    }

    public function register(RegisterRequest $request)
    {
        $toRegister             = $request->all();
        $toRegister['password'] = Hash::make($request->password);
        $user                   = User::create($toRegister);
        auth()->login($user);
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->all())) {
            auth()->login(User::where('email', $request->email)->first());

            return response(200);
        }

        return abort(401);
    }

    public function toApprove()
    {
        return User::where('approved', false)->where('staff', true)->get();
    }

    public function destroy(Request $request)
    {
        User::findOrFail($request->id)->delete();
    }

    public function approve(Request $request)
    {
        User::findOrFail($request->id)->update(['approved' => true]);
    }
}
