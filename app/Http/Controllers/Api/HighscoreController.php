<?php

namespace Rosa\Http\Controllers\Api;

use Rosa\User;
use Rosa\Http\Controllers\Controller;

class HighscoreController extends Controller
{
    public function listing()
    {
        return User::orderBy('score', 'DESC')->where('student', true)->get();
    }
}
