---
title: High level overview
---

## Monitoring uptime

This package can perform health checks on all your servers. It does this by ssh'ing into them an performing certain commands. It'll interpret the output giving the command to determine if the check failed or not.

Let's illustrate this with the `memcached` check which comes out of the box. This command will verify if [Memcached](https://memcached.org/) is running. This check will run `service memcached status` on a server. If that command outputs a string that contains `memcached is running` the check will succeed. If not, the check will fail.

When a check fails, and on other events, the package can send you a notification. This is how such a notification looks like in Slack.
 
 TO DO: add image.
 
 [In the config file](TO DO: add link) you can specify via which channels it will send notifications. By default the package has support for [Slack](https://slack.com/) and mail notifications. Because the package leverages Laravel's native notifications you can use any of the [community supported drivers](https://github.com/laravel-notification-channels) or [write your own](https://laravel.com/docs/5.4/notifications#custom-channels).
 
 Hosts and checks can be added via the [`add-host` artisan command]() or by manually [adding them](https://docs.spatie.be/laravel-server-monitor/v1/advanced-usage/manually-modifying-hosts-and-checks) in the `hosts` and `checks` table.

This package comes with a small number of [built in checks](TO DO: add link). It's laughably easy to add your [own checks](TO DO: add link).
