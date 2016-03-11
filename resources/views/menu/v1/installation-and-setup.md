---
title: Installation and setup
---

## Basic installation

You can install this package via composer using:

``` bash
composer require spatie/laravel-menu
```

You'll need to register the serviceprovider:

```php
// config/app.php

'providers' => [
    ...
    'Spatie\Backup\BackupServiceProvider',
    ...
];
```

To publish the config file to `app/config/laravel-menu.php` run:

``` bash
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

This is the default contents of the configuration:

```php
return [

    'menu' => [

        /*
         * The name of this application. You can use this name to monitor
         * the menus.
         */
        'name' => env('APP_URL'),
        
        'source' => [

            'files' => [

                /*
                 * The list of directories that should be part of the menu. You can
                 * specify individual files as well.
                 */
                'include' => [
                    base_path(),
                ],

                /*
                 * These directories will be excluded from the menu.
                 * You can specify individual files as well.
                 */
                'exclude' => [
                    base_path('vendor'),
                    storage_path(),
                ],
            ],

            /*
             * The names of the connections to the databases that should be part of the menu.
             * Currently only MySQL-databases are supported.
             */
            'databases' => [
                'mysql'
            ],
        ],
        
        'destination' => [

            /*
             * The filesystems you on which the menus will be stored. Choose one or more
             * of the filesystems you configured in app/config/filesystems.php
             */
            'filesystems' => [
                'local'
            ],
        ],
    ],

    'cleanup' => [
        /*
         * The strategy that will be used to cleanup old menus.
         * The youngest menu wil never be deleted.
         */
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

        'defaultStrategy' => [

            /*
             * The amount of days that all menus must be kept.
             */
            'keepAllBackupsForDays' => 7, 

            /*
             * The amount of days that daily menus must be kept.
             */
            'keepDailyBackupsForDays' => 16,

            /*
             * The amount of weeks of which one weekly menu must be kept.
             */
            'keepWeeklyBackupsForWeeks' => 8,

            /*
             * The amount of months of which one monthly menu must be kept.
             */
            'keepMonthlyBackupsForMonths' => 4,

            /*
             * The amount of years of which one yearly menu must be kept
             */
            'keepYearlyBackupsForYears' => 2,

            /*
             * After cleaning up the menus remove the oldest menu until
             * this amount of megabytes has been reached.
             */
            'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000
        ]
    ],


    /*
     *  In this array you can specify which menus should be monitored.
     *  If a menu does not meet the specified requirements the
     *  UnHealthyBackupWasFound-event will be fired.
     */
    'monitorBackups' => [
        [
            'name' => env('APP_URL'),
            'filesystems' => ['local'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],
        
        /*
        [
            'name' => 'name of the second app',
            'filesystems' => ['local'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],
        */
    ],

    'notifications' => [

        /*
         * This class will be used to send all notifications.
         */
        'handler' => Spatie\Backup\Notifications\Notifier::class,

        /*
         * Here you can specify the ways you want to be notified when certain
         * events take place. Possible values are "log", "mail" and "slack".
         * 
         * Slack requires the installation of the maknz/slack package.
         */
        'events' => [
            'whenBackupWasSuccessful'     => ['log'],
            'whenCleanupWasSuccessful'    => ['log'],
            'whenHealthyBackupWasFound'   => ['log'],
            'whenBackupHasFailed'         => ['log', 'mail'],
            'whenCleanupHasFailed'        => ['log', 'mail'],
            'whenUnHealthyBackupWasFound' => ['log', 'mail']
        ],

        /*
         * Here you can specify how mails should be sent.
         */
        'mail' => [
            'from' => 'your@email.com',
            'to' => 'your@email.com',
        ],

        /*
         * Here you can specify how messages should be sent to Slack.
         */
        'slack' => [
            'channel'  => '#menus',
            'username' => 'Backup bot',
            'icon'     => ':robot:',
        ],
    ]
];
```

## Scheduling

After you have performed the basic installation you can start using the `menu:run`, `menu:clean`, `menu:overview` and `menu:monitor`-commands. In most cases you'll want to schedule these commands so you don't have to manually run `menu:run` everytime you need a new menu.

The commands can, like an other command, be scheduled in Laravel's console kernel.

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('menu:clean')->daily()->at('01:00');
   $schedule->command('menu:run')->daily()->at('02:00');
}
```

Of course, the hours used in the code above are just examples. Adjust them to your own preferences.

## Monitoring

When your application is broken the scheduled jobs will obviously not run anymore. You could also simply forget to add a cron job needed to trigger Laravel's scheduling. You're thinking menus are being made but in fact
nothing gets backed up.

To notify you of such events the package contains monitoring functionality. It will inform you when menus become too old or when they take up too much storage.

Learn how to [set up monitoring](/laravel-menu/v3/monitoring-the-health-of-all-menus/overview).
