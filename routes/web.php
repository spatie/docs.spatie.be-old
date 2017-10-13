<?php

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('laravel-backup')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-backup/v5/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-backup/v3/introduction');
    });

    Route::get('v4', function () {
        return redirect('laravel-backup/v4/introduction');
    });
    

    Route::get('v5', function () {
        return redirect('laravel-backup/v5/introduction');
    });
});

Route::prefix('laravel-medialibrary')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-medialibrary/v6/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-medialibrary/v3/introduction');
    });

    Route::get('v4', function () {
        return redirect('laravel-medialibrary/v4/introduction');
    });

    Route::get('v5', function () {
        return redirect('laravel-medialibrary/v5/introduction');
    });

    Route::get('v6', function () {
        return redirect('laravel-medialibrary/v6/introduction');
    });
});

Route::prefix('menu')->group(function () {

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

Route::prefix('laravel-activitylog')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-activitylog/v2/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-activitylog/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('laravel-activitylog/v2/introduction');
    });
});

Route::prefix('laravel-slack-slash-command')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-slack-slash-command/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-slack-slash-command/v1/introduction');
    });
});

Route::prefix('laravel-uptime-monitor')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-uptime-monitor/v3/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-uptime-monitor/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('laravel-uptime-monitor/v2/introduction');
    });

    Route::get('v3', function () {
        return redirect('laravel-uptime-monitor/v2/introduction');
    });
});

Route::prefix('laravel-tags')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-tags/v2/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-tags/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('laravel-tags/v2/introduction');
    });
});

Route::prefix('image')->group(function () {

    Route::get('/', function () {
        return redirect('image/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('image/v1/introduction');
    });
});

Route::prefix('laravel-server-monitor')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-server-monitor/v1/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-server-monitor/v1/introduction');
    });
});

Route::prefix('laravel-html')->group(function () {

    Route::get('/', function () {
        return redirect('laravel-html/v2/introduction');
    });

    Route::get('v1', function () {
        return redirect('laravel-html/v1/introduction');
    });

    Route::get('v2', function () {
        return redirect('laravel-html/v2/introduction');
    });
});

Route::get('{slug}/edit', 'PageController@edit')->where('slug', '(.*)');
Route::get('{slug}', 'PageController@page')->where('slug', '(.*)');
