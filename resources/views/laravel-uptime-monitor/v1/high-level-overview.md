---
title: High level overview
---

## Monitoring uptime

This package can monitor the uptime of sites, api endpoints, or anything that communicates via `http` or `https`. To create a monitor use the `monitor:create` command. This will create a row in the `monitors`  table. 

The `monitor:check-uptime` task [should be scheduled](https://docs.spatie.be/laravel-uptime-monitor/v1/installation-and-setup#scheduling) to run every minute. When it runs it will send a request to the `url`  of every configured monitor. The package can perform requests in a concurrent way, so don't be afraid to configure a high number of monitors.
   
 If a request succeeds the `Spatie\UptimeMonitor\Events\MonitorSucceed` event will fire. The uptime of the monitor will be checked again in the run of `monitor:check-uptime` after the given amount of minutes configured in the `run_interval_in_minutes` key in the config file.

When an uptime check fails the uptime check for that monitor will be performed any time `monitor:check-uptime` runs regardless of the value configured in `run_interval_in_minutes`.
If the uptime check fails more times in a row then the value configured in `fire_down_event_after_consecutive_failures` the `Spatie\UptimeMonitor\Events\MonitorFailed` event will fire. 

When, after it has failed, an uptime check succeeds again the `Spatie\UptimeMonitor\Events\MonitorRecovered` will be fired.

## Monitoring SSL certificates

The package can verify if the ssl certificate of a monitor is valid. By default all monitors whose `url` starts with `https` will be checked. This is done by the `monitor:check-ssl` command which should be scheduled to run at least daily. 

When a valid certificate for a monitor is found the `Spatie\UptimeMonitor\Events\SslCheckSucceeded` event will fire. If no valid certificate is found, `Spatie\UptimeMonitor\Events\SslCheckFailed` event will be unleashed. 
 
 If a valid certificate is found, but it will expire in less days than the value configured in `fire_expiring_soon_event_if_certificate_expires_within_days`, the `Spatie\UptimeMonitor\Events\SslExpiresSoon` event fires off.
