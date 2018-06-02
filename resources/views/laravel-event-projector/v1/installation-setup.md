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

You must publish the config file with this command:

```bash
php artisan vendor:publish --provider="Spatie\EventProjector\EventProjectorServiceProvider" --tag="config"
```

This is the default content of the config file that will be published at `config/event-projector.php`:

```php
return [

    /*
     * Projectors are classes that build up projections. You can create them by
     * performing `php artisan event-projector:create-projector`. Projectors
     * can be registered in this array or a service provider.
     */
    'projectors' => [],

    /*
     * Reactors are classes that handle side effects. You can create them by
     * performing `php artisan event-projector:create-reactor`. Reactors
     * can be registered in this array or a service provider.
     */
    'reactors' => [],

    /*
     * A queue is used to guarantee that all events get passed to the projectors in
     * the right order. Here you can set of the name of the queue. In production
     * environments you must use a real queue and not the sync driver.
     */
    'queue' => env('EVENT_PROJECTOR_QUEUE_DRIVER', 'sync'),

    /*
     * This class is responsible for storing events. To add extra behavour you
     * can change this to a class of your own. The only restriction is that
     * it should extend \Spatie\EventProjector\Models\StoredEvent.
     */
    'stored_event_model' => \Spatie\EventProjector\Models\StoredEvent::class,

    /*
     * This class is responsible for projector statuses. To add extra behavour you
     * can change this to a class of your own. The only restriction is that
     * it should extend \Spatie\EventProjector\Models\ProjectorStatus.
     */
    'projector_status_model' => \Spatie\EventProjector\Models\ProjectorStatus::class,

    /*
     * This class is responsible for serializing events. By default an event will be serialized
     * and stored as json. You can customize the class name. A valid serializer
     * should implement Spatie\EventProjector\EventSerializers\Serializer.
     */
    'event_serializer' => \Spatie\EventProjector\EventSerializers\JsonEventSerializer::class,

    /*
     * When replaying events potentially a lot of events will have to be retrieved.
     * In order to avoid memory problems events will be retrieved in
     * a chuncked way. You can specify the chunk size here.
     */
    'replay_chunk_size' => 1000,

    /*
     * The diskname where the snapshots are stored. You can create a disk in the
     * default Laravel filesystems.php config file.
     */
    'snapshots_disk' => 'local',
];
```

Finally you should set up a queue. Specify the connection name in `queue` key of the `event-projector` config file. This queue will be used to guarantee that the events will be processed by all projectors in the right order. You should make sure that the queue will process only one job at a time. In a local environment, where events have a very low change of getting fired concurrently, it's probably ok to just use the `sync` driver.


