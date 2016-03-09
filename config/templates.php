<?php

return [
    'backup' => [
        'assetName' => 'backup',
        'baseUrl' => '/laravel-backup/v3',
        'facetFilters' => 'project:laravel-backup',
        'gitHubUrl' => 'https://github.com/spatie/laravel-backup',
        'menu' => navigation()->backup(),
        'siteSlogan' => 'One day you\'ll thank us for this',
        'siteTitle' => 'Laravel Backup',
        'version' => 3,
    ],

    'medialibrary' => [
        'assetName' => 'medialibrary',
        'baseUrl' => '/laravel-medialibrary/v3',
        'facetFilters' => 'project:laravel-medialibrary',
        'gitHubUrl' => 'https://github.com/spatie/laravel-medialibrary',
        'menu' => navigation()->medialibrary(),
        'siteSlogan' => 'Associate files with Eloquent models',
        'siteTitle' => 'Laravel Medialibrary',
        'version' => 3,
    ]
];
