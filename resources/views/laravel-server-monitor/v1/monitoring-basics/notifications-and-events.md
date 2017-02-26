---
title: Notifications and events
---

The package notifies you if certain events take place when running checks on your server. You can specify which channels the notifications for certain events should be sent in the config file. If you don't want any notifications for a certain event, just pass an empty array. Out of the box `slack` and `mail` are supported. If you want to use another channel or modify the notifications, read the section on [customizing notifications](https://docs.spatie.be/laravel-uptime-monitor/v1/advanced-usage/customizing-notifications).

## Throttling notifications

To avoid to burying you in notifications when a check fails or emits a warning, we'll throttle notifications for such events.

By default we'll only send you one notification an hour per warning or failure per check. When a check succeeds again we'll notify you as soon as possible.

In the [config file](https://docs.spatie.be/laravel-server-monitor/v1/installation-and-setup) your can customize the throttling behaviour by passing a differente value to `throttle_failing_notifications_for_minutes`.

## Available notifications

### CheckFailed

`Spatie\ServerMonitor\Notifications\Notifications\CheckFailed`

This notification will be sent whe calling `$this-check->failed()` in a check. This will also cause the `Spatie\ServerMonitor\Events\CheckFailed`-event to fire.

This is how the notification looks in Slack.

TO DO: add image
<img src="/images/server-monitor/check-failed.jpg" />

### CheckWarning

`Spatie\ServerMonitor\Notifications\Notifications\CheckWarning`

This notification will be sent whe calling `$this-check->warning()` in a check. This will also cause the `Spatie\ServerMonitor\Events\CheckWarning`-event to fire.

This is how the notification looks in Slack.

TO DO: add image
<img src="/images/server-monitor/check-warning.jpg" />


### CheckRestored

`Spatie\ServerMonitor\Notifications\Notifications\CheckRestored`

This notification will be sent when a check succeeds again after it had been failing. The 
`Spatie\ServerMonitor\Events\CheckRestored` event will be fired as well.

This is how the notification looks in Slack.

TO DO: add image
<img src="/images/server-monitor/check-restored.jpg" />

### CheckSucceeded

`Spatie\ServerMonitor\Notifications\Notifications\CheckSucceeded`

This notification will be sent whe calling `$this-check->succeeded()` in a check. This will also cause the `Spatie\ServerMonitor\Events\CheckSucceeded`-event to fire.

You probably don't want to be notified of this event as it is fired many many times. 
