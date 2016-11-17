---
title: Notifications
---

The package notifies you if certain events take place when running the uptime check. You can specify which channels the notifications for certain events should be sent in the config file. If you don't want any notifications for a certain event, just pass an empty array. Out of the box `slack` and `mail` are supported. If you want to use another channel or modify the notifications, read the section on [customizing notifications](https://docs.spatie.be/laravel-uptime-monitor/v1/advanced-usage/customizing-notifications).

## MonitorFailed

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorFailed`

This notification will be sent when the `Spatie\UptimeMonitor\Events\MonitorFailed` event is fired.

This is how the notification looks in Slack.

<img src="/images/uptime-monitor/monitor-failed.png" />

## MonitorRecovered

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorRecovered`

This notification will be sent when the `Spatie\UptimeMonitor\Events\MonitorRecovered` event is fired.

This is how the notification looks in Slack.

<img src="/images/uptime-monitor/monitor-recovered.png" />

## MonitorSucceeded

`Spatie\UptimeMonitor\Notifications\Notifications\MonitorSucceeded`

This notification will be sent when the `Spatie\UptimeMonitor\Events\MonitorSucceeded` event is fired.

You probably don't want to be notified of this event as it is fired many many times. 
