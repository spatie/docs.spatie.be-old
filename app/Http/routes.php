<?php

Route::get('/', function() {
   return redirect('https://spatie.be/opensource');
});

Route::get('laravel-backup', function() {
    return redirect('laravel-backup/v3/introduction');
});

Route::get('laravel-medialibrary', function() {
    return redirect('laravel-medialibrary/v3/introduction');
});

Route::get('{slug}', 'PageController@page')->where('slug', '(.*)');
