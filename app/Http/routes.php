<?php

Route::get('/', function () {
    return redirect('https://spatie.be/opensource');
});

Route::group(['prefix' => 'laravel-backup'], function () {

    Route::get('/', function () {
        return redirect('laravel-backup/v3/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-backup/v3/introduction');
    });

});

Route::group(['prefix' => 'laravel-medialibrary'], function () {

    Route::get('/', function () {
        return redirect('laravel-medialibrary/v4/introduction');
    });

    Route::get('v4', function () {
        return redirect('laravel-medialibrary/v4/introduction');
    });
});

Route::group(['prefix' => 'menu'], function () {

    Route::get('/', function () {
        return redirect('menu/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('menu/v1/introduction');
    });
});

Route::get('{slug}/edit', 'PageController@edit')->where('slug', '(.*)');
Route::get('{slug}', 'PageController@page')->where('slug', '(.*)');
