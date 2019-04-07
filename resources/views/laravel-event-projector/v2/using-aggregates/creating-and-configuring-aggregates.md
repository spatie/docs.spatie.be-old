---
title: Configuring aggregates
---

An aggregate is a class that decide to record events based on past events.

## Creating an aggregate 
 
The easiest way to create an aggregate root would be to use the `make:aggregate` command:

```php
php artisan make:projector MyAggregate
```

This will create a class like this:

```php
namespace App\Aggregates;

use Spatie\EventProjector\AggregateRoot;


final class MyAggregate extends AggregateRoot
{
}
```

## Retrieving an aggregate

An aggregate can be retrieved like this:

```php
MyAggregate::retrieve($uuid)
```

This will cause all events with the given `uuid` to be retrieved and fed to the aggregate. For example an event `MoneyAdded` will be passed to the `applyMoneyAdded` method on the aggregate if such a method exists.

## Recording events

Inside an aggregate your can record new events using the `recordEvent` function. All events being passed to that function should implement `Spatie\EventProjector\DomainEvent`.

Here's an example event

```php
use Spatie\EventProjector\DomainEvent;

class MoneyAdded extends DomainEvent
{
    /** @var int */
    private $amount

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
}
```

Inside an aggregate root you can pass the event to `recordEvent`:

```php
// somehwere inside your aggregate
public function addMoney(int $amount)
{
    $this->recordEvent(new MoneyAdded($amount));
}
```

Calling `recordEvent` will persist the event to the db, that will happen when the aggregate itself gets persisted. However, recording an event will cause it getting applied to the aggregate immediately. For example when you record the event `MoneyAdded`, we'll immediately call `applyMoneyAdded` on the aggregate.

Notice that your event isn't required to contain the `$uuid`. Your aggregate is built up for a specific `$uuid` and under the hood the package will save that `$uuid` along with the event when the aggregate gets persisted.

## Persisting aggregates

To persist an aggregate simply call `persist` on it. Here's an example:

```php
MyAggregate::retrieve($uuid) // will cause all events for this uuid to be fed to the `apply*` methods
   // call methods that record events
   ->persist(); // 
```

Persisting an aggregate root will write all newly recorded events to the database. The newly persisted events will get passed to all projectors and reactors.

## Registering projectors and reactors

In addition to registering projectors and reactors [in the config file or service provider](https://docs.spatie.be/laravel-event-projector/v2/using-projectors/creating-and-configuring-projectors#registering-projectors) you can also register them right in the aggregate. Simply add an instance variable called `$projectors` and/or `$reactors` and set it to an array of classnames projector/reactors.

```php
namespace App\Aggregates;

use Spatie\EventProjector\AggregateRoot;


final class MyAggregate extends AggregateRoot
{
    $projectors = [
        MyProjector::class,
    ];
    
    $reactors = [
        MyReactor::class,
    ];
}
```
