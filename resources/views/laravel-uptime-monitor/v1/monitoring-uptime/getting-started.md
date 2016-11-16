---
title: Adding and removing sites
---

## Creating your first monitor

After you've set up [the package](https://docs.spatie.be/laravel-uptime-monitor/v1/installation-and-setup) you can use the `monitor:add` command to monitor an url. Here's how to add a monitor for `https://laravel.com`:

```php
php artisan monitor:add https://laravel.com
```

You will be asked if the uptime check should look for a specific string in the response. This is handy if you know a few words that appear in the url you want to monitor. If you choose to specify a string and the string is not in the response when checking the url, the package will consider that uptime check failed.

If the url you want to monitor starts with `https://` the package will also [start monitoring](TODO: link needed) the ssl certificate of your site.

Now you've just set up your first monitor. Congratulations! The package will send you [notifications](TODO:link needed) when your monitor fails and when it is restored.
 
 Read the [high level overview section](https://docs.spatie.be/laravel-uptime-monitor/v1/high-level-overview) to know how the uptime checking works in detail.
 
 ## Removing a monitor
 
 You can remove a monitor by running  `monitor:delete`. Here's how to delete the monitor for `https://laravel.com`:
 
 ```php
 php artisan monitor:delete https://laravel.com
 ```
 
 This will remove the monitor for laravel.com from the database. Want to delete multiple monitors at once? Just pass them all comma-separated.
 
