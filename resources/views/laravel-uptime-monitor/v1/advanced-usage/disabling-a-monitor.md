---
title: Disabling a monitor
---

If you want to temporarily disable both the uptime and ssl check of a monitor you can disable it.

This is how to disable a monitor for `https://laravel.com`

```bash
php artisan monitor:disable https://laravel.com
```

You can enable the checks of a monitor again with:

```bash
php artisan monitor:enable https://laravel.com
```

Both commands accept multiple urls comma separated to enable or disable multiple monitors at once.
