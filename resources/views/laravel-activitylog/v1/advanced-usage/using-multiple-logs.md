---
title: Using multiple logs
---

## The default log

When not specify a log name the activities will be logged on the default log.

```php
activity()->log('hi');

$lastActivity = Spatie\Activitylog\Models\Activity::all()->last();

$lastActivity->log_name; //returns 'default';
```

You can specify the name of the default log in the `default_log_name` key of the config file.

## Specifying a log

You can specify the log on which an activity must be logged by passing the log name to the `activity` function:

```php
activity('other-log')->log("hi");
```

$lastActivity->log_name; //returns 'other-log';

## Retrieving activity

The `Activity` model is just a regular Eloquent Model that you know and love:

```php
Activity::where('log_name' , 'other-log')->get(); //returns all activity from the 'other-log'
```

There's also an `onLog` scope you can use:

```php
Activity::onLog('other-log')->get();

//you can pass multiple log names to the scope
Activity::onLog('default', 'other-log')->get();

//passing an array is just as good
Activity::onLog(['default', 'other-log'])->get();
```
