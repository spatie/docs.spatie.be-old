---
title: Installation and setup
---

## Basic installation

You can install this package via composer using:

``` bash
composer require spatie/laravel-uptime-monitor
```

You'll need to register the service provider:

```php
// config/app.php

'providers' => [
    // ...
    Spatie\UptimeMonitor\UptimeMonitorServiceProvider::class,
];
```

To publish the config file to `config/laravel-uptime-monitor.php` run:

``` bash
php artisan vendor:publish --provider="Spatie\UptimeMonitor\UptimeMonitorServiceProvider"
```

The default contents of the configuration looks like this:

```php
return [

    /*
     * You can get notified when specific events occur. Out of the box you can use 'mail'
     * and 'slack'. Of course you can also specify your own notification classes.
     */
    'notifications' => [

        'notifications' => [
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckFailed::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckRecovered::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckSucceeded::class => [],

            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckFailed::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateExpiresSoon::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckSucceeded::class => [],
        ],

        /*
         * The location from where you are running this Laravel application. This location will be mentioned
         * in all notifications that will be sent.
         */
        'location' => '',

        /*
         * To keep reminding you that a site is down notifications
         * will be resent every given amount of minutes.
         */
        'resend_uptime_check_failed_notification_every_minutes' => 60,

        'mail' => [
            'to' => 'your@email.com',
        ],

        'slack' => [
            'webhook_url' => env('UPTIME_MONITOR_SLACK_WEBHOOK_URL'),
        ],

        /*
         * Here you can specify the notifiable to which the notifications should be sent. The default
         * notifiable will use the variables specified in this config file.
         */
        'notifiable' => \Spatie\UptimeMonitor\Notifications\Notifiable::class,
        
        /**
         * The date format used in notifications.
         */
        'date_format' => 'd/m/Y',
    ],

    'uptime_check' => [

        /*
         * An uptime check will be performed if the last check was performed more than the
         * given number of minutes ago. If you change this setting you have to manually
         * update the `uptime_check_interval_in_minutes` value of your existing sites.
         *
         * When a site is down we'll check the uptime every time `sites:check-uptime` runs
         * regardless of this setting.
         */
        'uptime_check_interval_in_minutes' => 5,

        /*
         * To speed up the uptime checking process uptime monitor can check multiple sites
         * concurrently. Set this to a lower value if you're getting weird errors
         * running the uptime check.
         */
        'concurrent_checks' => 10,

        /*
         * The uptime check for a site will fail if site does not respond after the
         * given amount of seconds.
         */
        'timeout_per_site' => 10,

        /*
         * Fire `Spatie\UptimeMonitor\Events\UptimeCheckFailed` event only after
         * the given amount of checks have consecutively failed for a site.
         */
        'fire_monitor_failed_event_after_consecutive_failures' => 2,

        /*
         * When reaching out to sites this user agent will be used.
         */
        'user_agent' => 'spatie/laravel-uptime-monitor uptime checker',
    ],

    'certificate_check' => [

        /*
         * The `Spatie\UptimeMonitor\Events\CertificateExpiresSoon` event will fire
         * when a certificate is found whose expiration date is in
         * the next amount given days.
         */
        'fire_expiring_soon_event_if_certificate_expires_within_days' => 10,
    ],

    /*
     * To add or modify behaviour to the Site model you can specify your
     * own model here. They only requirement is that it should extend
     * `Spatie\UptimeMonitor\Test\Models\Site`.
     */
     'monitor_model' => Spatie\UptimeMonitor\Models\Monitor::class,
];
```

## Scheduling

After you have performed the basic installation you can check the uptime and ssl certificates of sites using the `monitor:check-uptime` and `monitor:check-certificate` commands. In most cases you'll want to schedule them. We recommend that you run the uptime check every minute and the ssl certificate check daily. 

You can schedule the commands, like any other command, in the console Kernel.

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('monitor:check-uptime')->everyMinute();
   $schedule->command('monitor:check-certificate')->daily();
}
```
