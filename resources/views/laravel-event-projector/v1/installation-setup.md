---
title: Installation & setup
---

laravel-event-projector can be installed via composer:

```bash
composer require spatie/laravel-event-projector:^1.0.0
```

The package will automatically register a service provider and a facade.

You need to publish and run the migrations to create the `stored_events` and `projector_statuses_tables`:

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
return [

    /*
     * This class is responsible for storing events. To add extra behavour you
     * can change this your a class of your own. The only restriction is that
     * it should extend \Spatie\EventProjector\Models\StoredEvent.
     */
    'stored_event_model' => \Spatie\EventProjector\Models\StoredEvent::class,

    /*
     * This class is responsible for serializing events. By default an event will be serialized
     * and stored as json. You can customize the class name. A valid serializer
     * should implement Spatie\EventProjector\EventSerializers\Serializer.
     */
    'event_serializer' => \Spatie\EventProjector\EventSerializers\JsonEventSerializer::class,


    'replay' => [

        /*
         * When replaying events potentially a lot of events will have to be retrieved.
         * In order to avoid memory problems events will be retrieved in
         * a chuncked way. You can specify the chucnk size here.
         */
        'chunk_amount' => 1000,
    ],
];
```

