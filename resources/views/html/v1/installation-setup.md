---
title: Installation & setup in Laravel
---

Laravel HTML can be installed via composer:

```bash
$ composer require spatie/laravel-html
```

Next, you need to register the service provider:

```php
// config/app.php
'providers' => [
    ...
    Spatie\Html\HtmlServiceProvider::class,
];
```

## `html()` helper method

Optionally we recommend to create a `html()` helper method. This way you can easily access the `HTML` instance and get code completion in your favourite IDE.

Start by creating the file `app/helpers.php` and add the following method:

```php
<?php

use Spatie\Html\Html;

function html(): Html
{
    return app(Html::class);
}
```

Next we'll need to tell composer to automatically load this file. We can do this by modifying `composer.json`. Look for the `autoload` section and add `app/helpers.php` to the `files` array:

```json
{
    "autoload": {
        "files": [
            "app/helpers.php"
        ]
    }
}
```

Finally dump the current autoloader with the following command:

```bash
composer dump-autoload
```
