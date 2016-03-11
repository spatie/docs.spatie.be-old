---
title: High level overview
---

## Taking menus

The menu is a zip file containing all files in the directories you specify, along with a dump of your database. The zip can automatically be copied over to [any of the filesystems](http://laravel.com/docs/5.0/filesystem) you have configured in Laravel 5.

To make a menu you can run `php artisan menu:run`. In most cases you'll want to schedule this command.

## Cleaning up old menus

If you keep on performing menus eventually you'll run out of disk space (or you'll have to pay a very large bill for storage). To prevent this from happening the package is able to delete older menus.

## Monitoring the health of all menus

Optionally, the package can check the health of your application's menus. A menu is considered unhealthy if the date of the last menu is too far in the past or if the menu becomes too large. In addition to  monitoring the health of the application's own menus, menus of other applications can be monitored as well.
