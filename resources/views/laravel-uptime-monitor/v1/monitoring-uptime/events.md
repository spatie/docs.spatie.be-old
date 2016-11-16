---
title: Events
---

These events are fired by the uptime check of a monitor.

## MonitorFailed

`Spatie\UptimeMonitor\Events\MonitorFailed`

This event is fired when the uptime check of the monitor has consecutively failed a couple of times. The specific number of failures can be configured in the `fire_monitor_failed_event_after_consecutive_failures` key in the config file. This happens when the configured `url` could not be reached or, if you specified it, the `look_for_string`  could not be found on the response. 

It has one public property `$monitor` that contains an instance of `Spatie\UptimeMonitor\Models\Monitor`.

## MonitorRecovered

`Spatie\UptimeMonitor\Events\MonitorRecovered`

This is event fired after the uptime check is succesfull after it has failed.

It has one public property `$monitor` that contains an instance of `Spatie\UptimeMonitor\Models\Monitor`.

## MonitorSucceeded

`Spatie\UptimeMonitor\Events\MonitorSucceeded`

This event is fired when the monitor could reach the configured `url` and, if you specified it, found the `look_for_string` on the response. This event only takes the uptime check in consideration, so it will still be fired if the ssl certificate check of the monitor is failing.

It has one public property `$monitor` that contains an instance of `Spatie\UptimeMonitor\Models\Monitor`.


