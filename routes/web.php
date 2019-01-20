<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $user = Rosa\User::find(1);

    // Creating a token without scopes...
    $token = $user->createToken('Token Name')->accessToken;

    // Creating a token with scopes...
    $token = $user->createToken('My Token', ['place-orders'])->accessToken;

    return $token;
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return view('login');
})->name('login');

Route::get('logout', function () {
    auth()->logout();

    return redirect()->route('login');
})->name('logout');

Route::group(['prefix' => 'user'], function () {
    Route::post('exists', 'UserController@exists');

    Route::post('register', 'UserController@register');

    Route::post('login', 'UserController@login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('users', 'HomeController@users')->name('users');

    Route::get('lessons', 'HomeController@lessons')->name('lessons');

    Route::get('keys', 'HomeController@keys')->name('keys');

    Route::get('users/to-approve', 'UserController@toApprove');

    Route::delete('user/destroy/{id}', 'UserController@destroy');

    Route::put('user/approve', 'UserController@approve');

    Route::group(['prefix' => 'resource'], function () {
        Route::resources([
            'lessons' => 'LessonController',
        ]);
    });

    Route::post('lessons/masthead', 'LessonController@masthead');

    Route::group(['prefix' => 'planning'], function () {
        Route::post('term', 'PlanningController@createTerm');

        Route::get('/', 'PlanningController@planning');
    });
});
