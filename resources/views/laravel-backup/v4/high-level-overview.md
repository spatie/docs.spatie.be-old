---
title: High level overview
---

## Taking backups

The backup is a `.zip` file containing all files in the directories you specify, along with a dump of your database (MySQL and PostgreSQL are supported). The `.zip` file can be automatically copied over to [any of the filesystems](https://laravel.com/docs/5.3/filesystem) you have configured.

To perform a new backup you just have to run `php artisan backup:run`. In most cases you'll want to schedule this command.

## Cleaning up old backups

If you keep on performing backups, eventually you'll run out of disk space (or you'll have to pay a very large bill for storage). To prevent this from happening the package is able to delete older backups.

## Monitoring the health of all backups

Optionally, the package can check the health of your application's backups. A backup is considered unhealthy if the date of the last backup is too far in the past or if the backup becomes too large. In addition to monitoring the health of the application's own backups, backups of other applications can be monitored as well.
