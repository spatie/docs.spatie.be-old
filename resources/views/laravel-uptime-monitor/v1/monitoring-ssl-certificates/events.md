---
title: Events
---

These events are fired by the ssl certificate check of a monitor.

## SslCheckFailed

`Spatie\UptimeMonitor\Events\SslCheckFailed`

This event is fired when the ssl check could not find a certificate or if the found certificate is invalid. Reasons why the certificate is considered invalid include it being expired or it not covering right domain.

It has these public properties:

- `$monitor`: the instance of `Spatie\UptimeMonitor\Models\Monitor` that fired of the event
- `$reason`: a string explaining why the ssl check failed
- `$certificate`: if a certificate was found this variable contains an instance of `\Spatie\SslCertificate\SslCertificate` Refer to the [documentation of `spatie/ssl-certificate`](https://github.com/spatie/ssl-certificate) to learn how to work with this object. 

## SslCheckSucceeded

`Spatie\UptimeMonitor\Events\MonitorRecovered`

This is event fired after the ssl check found a certificate that is valid.

It has these public properties:

- `$monitor`: the instance of `Spatie\UptimeMonitor\Models\Monitor` that fired of the event
- `$certificate`: if a certificate was found this variable contains an instance of `\Spatie\SslCertificate\SslCertificate` Refer to the [documentation of `spatie/ssl-certificate`](https://github.com/spatie/ssl-certificate) to learn how to work with this object. 

It has one public property `$monitor` that contains an instance of `Spatie\UptimeMonitor\Models\Monitor`.

## SslExpiresSoon

`Spatie\UptimeMonitor\Events\SslExpiresSoon`

This event is fired in addition to `SslCheckSucceeded` when the ssl check found a ssl certificate that is going to expires in the amount of days configured in `fire_expiring_soon_event_if_certificate_expires_within_days` or less.

It has these public properties:

- `$monitor`: the instance of `Spatie\UptimeMonitor\Models\Monitor` that fired of the event
- `$certificate`: if a certificate was found this variable contains an instance of `\Spatie\SslCertificate\SslCertificate` Refer to the [documentation of `spatie/ssl-certificate`](https://github.com/spatie/ssl-certificate) to learn how to work with this object. 
