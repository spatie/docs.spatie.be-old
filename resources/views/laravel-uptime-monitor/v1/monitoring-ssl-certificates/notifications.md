---
title: Notifications
---

The package can notify you when certain events take place when running the ssl certificate check. You can specify which channels the notifications for certain events should be sent in the config file. If you don't want notifications for a certain event, just pass an empty array. `slack` and `mail` channels are supported out of the box. If you want to use another channel or want to modify the notifications read the section on [customizing notifications](https://docs.spatie.be/laravel-uptime-monitor/v1/advanced-usage/customizing-notifications.

## SslCheckFailed

`Spatie\UptimeMonitor\Notifications\Notifications\SslCheckFailed`

This notification will be sent when the `Spatie\UptimeMonitor\Events\SslCheckFailed` event is fired.

This is how the notification looks in Slack.

TODO: add image

## SslExpiresSoon

`Spatie\UptimeMonitor\Notifications\Notifications\SslExpiresSoon`

This notification will be sent when the `Spatie\UptimeMonitor\Events\SslExpiresSoon` event is fired.

This is how the notification looks in Slack.

TODO: add image

## SslCheckSucceeded

`Spatie\UptimeMonitor\Notifications\Notifications\SslCheckSucceeded`

This notification will be sent when the `Spatie\UptimeMonitor\Events\SslCheckSucceeded` event was fired.

Probably you don't want to be notified of this event as it is fired many many times. 
