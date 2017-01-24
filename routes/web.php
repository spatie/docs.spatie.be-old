<?php

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-backup'], function () {

    Route::get('/', function () {
        return redirect('laravel-backup/v4/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-backup/v3/introduction');
    });

    Route::get('v4', function () {
        return redirect('laravel-backup/v4/introduction');
    });
});

Route::group(['prefix' => 'laravel-medialibrary'], function () {

    Route::get('/', function () {
        return redirect('laravel-medialibrary/v4/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-medialibrary/v3/introduction');
    });

    Route::get('v4', function () {
        return redirect('laravel-medialibrary/v4/introduction');
    });
});

Route::group(['prefix' => 'menu'], function () {

    Route::get('/', function () {
        return redirect('menu/v2/introduction');
    });

    Route::get('v1', function () {
        return redirect('menu/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('menu/v2/introduction');
    });
});

Route::group(['prefix' => 'laravel-activitylog'], function () {

    Route::get('/', function () {
        return redirect('laravel-activitylog/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-activitylog/v1/introduction');
    });
});

Route::group(['prefix' => 'laravel-slack-slash-command'], function () {

    Route::get('/', function () {
        return redirect('laravel-slack-slash-command/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-slack-slash-command/v1/introduction');
    });
});

Route::group(['prefix' => 'laravel-uptime-monitor'], function () {

    Route::get('/', function () {
        return redirect('laravel-uptime-monitor/v2/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-uptime-monitor/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('laravel-uptime-monitor/v1/introduction');
    });
});

Route::group(['prefix' => 'laravel-tags'], function () {

    Route::get('/', function () {
        return redirect('laravel-tags/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-tags/v1/introduction');
    });
});

Route::get('{slug}/edit', 'PageController@edit')->where('slug', '(.*)');
Route::get('{slug}', 'PageController@page')->where('slug', '(.*)');
