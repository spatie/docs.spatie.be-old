---
title: Using multiple logs
---

When not specify a log name the activities will be logged on the default log.

```php
activity()->log("hi");

$lastActivity = Spatie\Activitylog\Models\Activity::all()->last();

$lastActivity->log_name // returns "default";
```

You can specify the name of the default log in the `default_log_name` key of the config file.