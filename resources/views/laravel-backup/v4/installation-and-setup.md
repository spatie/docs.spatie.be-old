---
title: Installation and setup
---

## Basic installation

You can install this package via composer using:

``` bash
composer require spatie/laravel-backup
```

You'll need to register the service provider:

```php
// config/app.php

'providers' => [
    // ...
    Spatie\Backup\BackupServiceProvider::class,
];
```

To publish the config file to `config/laravel-backup.php` run:

``` bash
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

This is the default contents of the configuration:

```php
//config/laravel-backup.php


return [

    'backup' => [

        /*
         * The name of this application. You can use this name to monitor
         * the backups.
         */
        'name' => env('APP_URL'),

        'source' => [

            'files' => [

                /*
                 * The list of directories and files that will be included in the backup.
                 */
                'include' => [
                    base_path(),
                ],

                /*
                 * These directories and files will be excluded from the backup.
                 */
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                ],

                /*
                 * Determines if symlinks should be followed.
                 */
                'followLinks' => false,
            ],

            /*
             * The names of the connections to the databases that should be backed up
             * Only MySQL- and PostgreSQL-databases are supported.
             */
            'databases' => [
                'mysql',
            ],
        ],

        'destination' => [

            /*
             * The disk names on which the backups will be stored.
             */
            'disks' => [
                'local',
            ],
        ],
    ],


    /*
     * You can get notified when specific events occur. Out of the box you can use 'mail' and 'slack'.
     * For Slack you need to install guzzlehttp/guzzle.
     *
     * You can also use your own notification classes, just make sure the class is named after one of
     * the `Spatie\Backup\Events` classes.
     */
    'notifications' => [

        'notifications' => [
            \Spatie\Backup\Notifications\Notifications\BackupHasFailed::class         => ['mail'],
            \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\CleanupHasFailed::class        => ['mail'],
            \Spatie\Backup\Notifications\Notifications\BackupWasSuccessful::class     => ['mail'],
            \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound::class   => ['mail'],
            \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful::class    => ['mail'],
        ],

        /*
         * Here you can specify the notifiable to which the notifications should be sent. The default
         * notifiable will use the variables specified in this config file.
         */
        'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,

        'mail' => [
            'to' => 'your@email.com',
        ],

        'slack' => [
            'webhook_url' => '',
        ],
    ],

    /*
     * Here you can specify which backups should be monitored.
     * If a backup does not meet the specified requirements the
     * UnHealthyBackupWasFound-event will be fired.
     */
    'monitorBackups' => [
        [
            'name' => env('APP_URL'),
            'disks' => ['local'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],

        /*
        [
            'name' => 'name of the second app',
            'disks' => ['local', 's3'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],
        */
    ],


    'cleanup' => [
        /*
         * The strategy that will be used to cleanup old backups. The default strategy
         * will keep all backups for a certain amount of days. After that period only
         * a daily backup will be kept. After that period only weekly backups will
         * be kept and so on.
         *
         * No matter how you configure it the default strategy will never
         * deleted the newest backup.
         */
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

        'defaultStrategy' => [

            /*
             * The amount of days that all backups must be kept.
             */
            'keepAllBackupsForDays' => 7,

            /*
             * The amount of days that all daily backups must be kept.
             */
            'keepDailyBackupsForDays' => 16,

            /*
             * The amount of weeks of which one weekly backup must be kept.
             */
            'keepWeeklyBackupsForWeeks' => 8,

            /*
             * The amount of months of which one monthly backup must be kept.
             */
            'keepMonthlyBackupsForMonths' => 4,

            /*
             * The amount of years of which one yearly backup must be kept.
             */
            'keepYearlyBackupsForYears' => 2,

            /*
             * After cleaning up the backups remove the oldest backup until
             * this amount of megabytes has been reached.
             */
            'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
        ],
    ],
];

```

## Scheduling

After you have performed the basic installation you can start using the `backup:run`, `backup:clean`, `backup:list` and `backup:monitor` commands. In most cases you'll want to schedule these commands so you don't have to manually run `backup:run` everytime you need a new backup.

The commands can be scheduled in Laravel's console kernel, just like any other command.

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('backup:clean')->daily()->at('01:00');
   $schedule->command('backup:run')->daily()->at('02:00');
}
```

Of course, the hours used in the code above are just examples. Adjust them to suit your own preferences.

## Monitoring

When your application is broken the scheduled jobs will obviously not run anymore. You could also simply forget to add a cron job needed to trigger Laravel's scheduling. You think backups are being made when in fact nothing gets backed up.

To notify you of such events the package contains monitoring functionality. It will inform you when backups become too old or when they take up too much storage.

Learn how to [set up monitoring](/laravel-backup/v4/monitoring-the-health-of-all-backups/overview).

## Dumping the database
`mysqldump` and `pg_dump` are used to dump the database. If they are not installed in a default location, you can add a key named `dump_command_path` in Laravel's own `database.php` config file. Be sure to only fill in the path to the binary without the name of the binary itself.

If your database dump takes a long time you might hit the default timeout of 60 seconds. You can set a higher (or lower) limit by providing a `dump_command_timeout` config key which sets how long the command may run in seconds.

Here's an example for MySQL:

```php
//config/databases.php
'connections' => [
	'mysql' => [
		'driver'    => 'mysql'
		...,
		'dump' => [
		   'dump_command_path => '/path/to/the/binary' // only the path, so without 'mysqldump' or 'pg_dump'
		   'use_single_transaction'
		   'timeout => 5
		   'exclude_tables' => ['table1', 'table2'] 
           'add_extra_option' => '--optionname=optionvalue'  
		]  
	],
```
