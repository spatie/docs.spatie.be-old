---
title: Manually modifying monitors
---

All configured monitors are stored in the `monitors` table in the database. The various `monitor` commands manipulate the data that table:
 
 - `monitor:create` adds a row
 - `monitor:delete` deletes a row
 - `monitor:enable` and `monitor:disable` change the value of the `enabled` field
 - `monitor:list` lists all rows
 
You can also manually manipulate the table rows instead. Here's a description of the fields you can manipulate:
 
 - `id`: your regular auto increment value.
 - `url`: the url to perform uptime and ssl certificate checks on. Take care not to insert duplicate values.
 - `enabled`: this is the master switch of the uptime and ssl certificate checks. If this is `false` those checks will not be executed.
 - `look_for_string`: if this string is not found in the response the uptime check will fail. You may set this to an empty string to disable the check.
 - `uptime_check_interval_in_minutes`: if the uptime check was succesful that site won't be checked again for at least this number of minutes. When a monitor is created this field is filled with the value of `run_interval_in_minutes` in the config file.
 - `uptime_check_get_method`: the `http` method used by the uptime check. If `look_for_string` is specified when creating the monitor this will be set to `get`, otherwise this will be `head`.
 
 All other fields in the `monitors` table are managed by the package and should not be manually modified.
 
