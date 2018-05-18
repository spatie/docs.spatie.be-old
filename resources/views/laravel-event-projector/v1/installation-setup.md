---
title: Installation & setup
---

Medialibrary can be installed via composer:

```bash
composer require spatie/laravel-event-projector:^1.0.0
```

The package will automatically register a service provider and a facade.

You need to publish and run the migration:

```bash
php artisan vendor:publish --provider="Spatie\EventProjector\EventProjectorServiceProvider" --tag="migrations"
php artisan migrate
```

Publishing the config file is optional:

```bash
php artisan vendor:publish --provider="Spatie\EventProjector\EventProjectorServiceProvider" --tag="config"
```

This is the default content of the config file:

```php
//TODO
```

