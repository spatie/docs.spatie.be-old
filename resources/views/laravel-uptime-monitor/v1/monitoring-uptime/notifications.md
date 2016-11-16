---
title: Notifications
---

The package can notify you when certain events take place. In the config file you can specify to which channels the notification for certain events should be sent. If you don't want any notifications for a certain event, just pass an empty array. Out of the box `slack` and `mail` channels are supported. If you want to use another channel or want to modify the notifications read the section on [customizing notifications](TODO: add link).

## MonitorFailed

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorFailed`

This notification will be sent when the `Spatie\UptimeMonitor\Events\UptimeMonitor` is fired.

This is how the notification looks like in Slack.

TODO: add image

## MonitorRecovered

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorRecovered`

This notification will be sent when the `Spatie\UptimeMonitor\Events\MonitorRecovered` is fired.

This is how the notification looks like in Slack.

TODO: add image

## MonitorSucceeded

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorRecovered`

This notification will be sent when the `Spatie\UptimeMonitor\Events\MonitorSucceeded` is fired.

Probably you don't want to be notified of this event as it is fired many many times. 