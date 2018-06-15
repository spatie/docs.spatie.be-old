---
title: Using reactors
---

A reactor is a class, that much like a projector, listens for incoming events. Unlike projectors however, reactors will not get called when events are replayed. Reactors will only get called when the original event fires.

## Creating reactors

Let's create a reactor. You can perform this artisan command to create a projector in `app\Reactors`:

```php
php artisan make:reactor BigAmountAddedReactor
```

## Registering reactors

Reactors can be registered in the `reactors` key of the `event-projectors` config file.

Alternatively, they can be added to the `EventProjectionist`. This can be done anywhere, but typically you would do this in a ServiceProvider of your own.

```php
namespace App\Providers;

use App\Projectors\AccountBalanceProjector;
use Illuminate\Support\ServiceProvider;
use Spatie\EventProjector\Facades\EventProjectionist;

class EventProjectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // adding a single reactor
        EventProjectionist::addReactor(BigAmountAddedReactor::class);

        // you can also add multiple reactors in one go
        EventProjectionist::addReactors([
            AnotherReactor::class,
            YetAnotherReactor::class,
        ]);
    }
}
```

## Using reactors

This is the contents of a class created by the artisan command mentioned in the section above:

```php
namespace App\Reactors;

class BigAmountAddedReactor
{
    /*
     * Here you can specify which event should trigger which method.
     */
    protected $handlesEvents = [
        // EventHappened::class => 'onEventHappened',
    ];

    /*
    public function onEventHappened(EventHappended $event)
    {

    }
    */
}
```

The `$handlesEvents` property is an array which has event class names as keys and method names as values. Whenever an event is fired that matches one of the keys in `$handlesEvents` the corresponding method will be fired. You can name your methods however you like.

Here's an example where we listen for a `MoneyAdded` event:

```php
namespace App\Reactors;

use App\Events\MoneyAdded;

class BigAmountAddedReactor
{
    /*
     * Here you can specify which event should trigger which method.
     */
    protected $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',

    ];

    public function onAccountCreated(MoneyAdded $event)
    {
        // do some work
    }
}
```

This reactor will be created using the container so you may inject any dependency you'd like. In fact, all methods present in `$handlesEvent` can make use of method injection, so you can resolve any dependencies you need in those methods as well. Any variable in the method signature with the name `$event` will receive the event you're listening for.
