<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
   return redirect('https://spatie.be/opensource');
});

Route::get('laravel-backup', function() {
    return redirect('laravel-backup/v3/introduction');
});

Route::get('laravel-medialibrary', function() {
    return redirect('laravel-medialibrary/v3/introduction');
});

Route::get('{slug}', function () {
    $viewName = str_replace('/', '.', request()->getRequestUri());
    return view($viewName);
})->where('slug', '(.*)');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
