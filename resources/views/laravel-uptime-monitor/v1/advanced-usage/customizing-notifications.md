---
title: Customizing notifications
---

This package leverages [Laravel's native notification capabilites](https://laravel.com/docs/5.3/notifications) to send out [several](https://docs.spatie.be/laravel-uptime-monitor/v1/monitoring-uptime/notifications) [notifications](https://docs.spatie.be/laravel-uptime-monitor/v1/monitoring-ssl-certificates/notifications). 

```php
'notifications' => [
    \Spatie\UptimeMonitor\Notifications\Notifications\MonitorFailed::class => ['slack'],
    \Spatie\UptimeMonitor\Notifications\Notifications\MonitorRecovered::class => ['slack'],
    \Spatie\UptimeMonitor\Notifications\Notifications\MonitorSucceeded::class => [],

    \Spatie\UptimeMonitor\Notifications\Notifications\SslCheckFailed::class => ['slack'],
    \Spatie\UptimeMonitor\Notifications\Notifications\SslExpiresSoon::class => ['slack'],
    \Spatie\UptimeMonitor\Notifications\Notifications\SslCheckSucceeded::class => [],
],
```

Notice that the config keys are fully qualified class names of the `Notification` classes. All notifications have support for `slack` and `mail` out of the box. If you want to add support for more channels or just want to use change some text in the notifications you can specify your own notification classes in the config file. When creating custom notifications, it's probably best to extend the default ones shipped with this package.
