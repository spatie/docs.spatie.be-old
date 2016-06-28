---
title: Installation and Setup
---

The package can be installed via composer:

``` bash
composer require spatie/laravel-activitylog
```

Next, you must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    Spatie\Activitylog\ActivitylogServiceProvider::class,
];
```

You can publish the migration with:
```bash
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="migrations"
```

After the migration has been published you can create the `activity_log` table by running the migrations:

```bash
php artisan migrate
```

You can optionally publish the config file with:
```bash
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /**
     * When running the clean-command all recording activites older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,


    /**
     * When not specifying a log name when logging activity
     * we'll using this log name.
     */
    'default_log_name' => 'default'
];
```
