<?php

namespace Rosa\Http\Controllers\Api;

use Rosa\Week;
use Rosa\Http\Controllers\Controller;

class WeekController extends Controller
{
    public function current()
    {
        $week = Week::current();

        return $week->load('lessons');
    }
}
