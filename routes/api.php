<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user'], function () {
    Route::post('login', 'Api\StudentController@login');
    Route::post('register', 'Api\StudentController@register');
    Route::post('exists', 'Api\StudentController@exists');
});

/* Unprotected routes */
Route::get('lessons', 'LessonController@index');

Route::get('term', 'PlanningController@planning');

Route::get('teachers', "Api\UserController@teachers");

/* Auth protected routes */
Route::group(['middleware' => 'auth:api'], function () {
    /* Resource routes */
    Route::group(['prefix' => 'resource'], function () {
        Route::resource('user', "Api\UserController");
    });

    Route::put('student/attendance', "Api\StudentController@markAttendance");

    Route::post('user/avatar', "Api\UserController@setAvatar");

    Route::get('highscores', "Api\HighscoreController@listing");
});

Route::get('/test', function () {
    $user = Rosa\User::first();
    $user->rank = $user->position();

    return $user;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user()->load('attendance.lessons');
    $user->rank = $user->position();

    return $user;
});
