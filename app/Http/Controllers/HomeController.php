<?php

namespace Rosa\Http\Controllers;

use Rosa\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with(['user' => auth()->user(), 'hasUsersToApprove' => true]);
    }

    public function lessons()
    {
        return view('lessons')->with(['user' => auth()->user()]);
    }

    public function users()
    {
        $approve = User::where('staff', true)->where('approved', false)->get();

        return view('users')->with(['user' => auth()->user(), 'approve' => $approve]);
    }

    public function keys()
    {
        return view('keys')->with(['user' => auth()->user(), 'hasUsersToApprove' => true]);
    }
}
