---
title: Using event streams
---

A projector will by default only handle an event if that projector has received all previous events. If your application receives a lot of concurrent requests, it will result in a lot of events being fired. In such a scenario there's a high chance that projectors won't get events in the right order.

Imagine that there are many requests coming in at the same time that each want to add money to 100 different accounts.

In a first request an event `AmountAdded` for account 1 is stored. The stored event gets id 1. In that request the projector now starts to update the amount of the account. But before that update completes, another one has already stored its own `AmountAdded` event for account 2. But because event 1 is not completed yet, the projector will not accept event 2. The projector is now out of sync and will not accept new events until you've [replayed](laravel-event-projector/v1/replaying-events/replaying-events) all of them.

If you think about it, the projector should perfectly be able to handle events related to account 2 even if it has not handled all events regarding for account 1. 

## Preparing your event to use streams

You can make a projector understand the situation above by implementing two methods on your event: `getStreamName()` and `getStreamId()`. Here's an example for the `AmountAdded` event.

```php
use Illuminate\Queue\SerializesModels;
use Spatie\EventProjector\ShouldBeStored;
use App\Models\Account;

class MoneyAdded implements ShouldBeStored
{
    use SerializesModels;

    /** @var \App\Models\Account */
    public $account;

    /** @var int */
    public $amount;

    public function __construct(Account $account, int $amount)
    {
        $this->account = $account;

        $this->amount = $amount;
    }

    public function getStreamName(): string
    {
        return 'accounts';
    }

    public function getStreamId()
    {
        return $this->account->id;
    }
}
```

## Preparing your projector to use streams

Next you must let the projector know it should handle streamed events. This can be done by adding a `$streamBased` property and setting it to `true`. 

```php
use App\Models\Account;
use App\Events\Streamable\MoneyAdded;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class StreambasedProjector implements SyncProjector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
    ];

    protected $streamBased = true;

    public function onMoneyAdded(MoneyAdded $event)
    {
        $event->account->addMoney($event->amount);
    }
}
```

This projector will now accept events for account 2 even if all events for account 1 are not handled yet.





